<?php
/**
 * @author Developers-Alliance team
 * @copyright Copyright (c) 2023 Developers-alliance (https://www.developers-alliance.com)
 * @package Shipping Table Rates for Magento 2
 */

declare(strict_types=1);

namespace DevAll\TableRates\Model;

use DevAll\TableRates\Api\Data\TablerateInterface;
use DevAll\TableRates\Api\TablerateRepositoryInterface;
use Magento\Framework\App\ResourceConnection;
use Magento\OfflineShipping\Model\ResourceModel\Carrier\Tablerate;

/**
 * Tablerate Repository Class
 */
class TablerateRepository implements TablerateRepositoryInterface
{
    /**
     * @var Tablerate
     */
    private $tablerateResource;

    /**
     * @var TablerateFactory
     */
    private $tablerateFactory;

    /**
     * @var ResourceConnection
     */
    private $resource;

    /**
     * @param Tablerate $tablerateResource
     * @param TablerateFactory $tablerateFactory
     * @param ResourceConnection $resource
     */
    public function __construct(
        Tablerate $tablerateResource,
        TablerateFactory $tablerateFactory,
        ResourceConnection $resource
    ) {
        $this->tablerateResource = $tablerateResource;
        $this->tablerateFactory = $tablerateFactory;
        $this->resource = $resource;
    }

    /**
     * @inheritDoc
     */
    public function saveFromArray(array $data) {
        $this->tablerateResource->save(
            $this->arrayToModelObject(
                $this->sanitizeFloatValues($data)
            )
        );
    }

    /**
     * @inheritDoc
     */
    public function deleteByPk(int $pk) {
        $tableRate = $this->tablerateFactory->create();
        $tableRate->setPk($pk);
        $this->tablerateResource->delete($tableRate);
    }

    /**
     * @inheritDoc
     */
    public function deleteByCollection($collection) {
        $deleteList = $collection->getAllIds();

        /*
            Underlying ResourceModel and AbstractDB classes doesn't contain logic
            for removing multiple records at the same time.
            Loading and removing one by one is not efficient,
            Overriding ResourceModel would play bad for flexibility/extensibility,
            Therefore Execution of queries directly is best approach
        */
        $tableName = $this->resource->getTableName(TablerateInterface::TABLE_RATES_TABLE_NAME);
        $connection = $this->resource->getConnection();
        $connection->delete($tableName, [TablerateInterface::PK . ' IN (?)' => $deleteList]);
    }

    /**
     * @inheritDoc
     */
    public function arrayToModelObject(array $data): \DevAll\TableRates\Model\Tablerate
    {
        $tableRate = $this->tablerateFactory->create();

        // Specify the allowed properties for the table rate model
        $allowedProperties = [
            TablerateInterface::PK,
            TablerateInterface::WEBSITE_ID,
            TablerateInterface::DEST_COUNTRY_ID,
            TablerateInterface::DEST_REGION_ID,
            TablerateInterface::DEST_ZIP,
            TablerateInterface::CONDITION_NAME,
            TablerateInterface::CONDITION_VALUE,
            TablerateInterface::PRICE,
        ];

        // Filter the data array to include only the allowed properties
        $tableRateData = array_intersect_key($data, array_flip($allowedProperties));

        // If pk is empty, set it to null and the resource model will create a new record automatically instead of updating
        if (empty($tableRateData[TablerateInterface::PK])) {
            $tableRateData[TablerateInterface::PK] = null;
        }

        return $tableRate->setData($tableRateData);
    }

    /**
     * Sanitize float values in an array
     *
     * @param array $data
     * @return array
     * @throws \Exception
     */
    private function sanitizeFloatValues(array $data): ?array
    {
        $keys = [
            TablerateInterface::PRICE,
            TablerateInterface::CONDITION_VALUE
        ];

        foreach ($keys as $key) {
            if (isset($data[$key])) {
                $data[$key] = $this->extractFloatFromString($data[$key]);
                if ($data[$key] === null) {
                    return null;
                }
            }
        }

        return $data;
    }

    /**
     * Remove redundant characters and convert to float
     * Inline editing component doesn't handle currency symbol
     * So we have to handle it here
     *
     * @param $str
     * @return float
     * @throws \Exception
     */
    private function extractFloatFromString($str): float
    {
        // Remove all non-digit and non-decimal characters from the string
        $cleanStr = preg_replace('/[^0-9.]/', '', $str);

        // Extract the floating-point number from the cleaned string
        preg_match('/\d+(\.\d+)?/', $cleanStr, $matches);

        // Check if a match is found
        if (isset($matches[0])) {
            return floatval($matches[0]);
        }

        // If no match is found, Throw an exception
        throw new \Exception(
            __('Number Format incorrect, Write decimal number with dot notation, example: 1.50')
        );
    }

}
