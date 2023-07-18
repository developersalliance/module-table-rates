<?php
/**
 * @author Developers-Alliance team
 * @copyright Copyright (c) 2023 Developers-alliance (https://www.developers-alliance.com)
 * @package Shipping Table Rates for Magento 2
 */

declare(strict_types=1);

namespace DevAll\TableRates\Ui\Component;

use Magento\Ui\DataProvider\Modifier\PoolInterface;
use Magento\Ui\DataProvider\ModifierPoolDataProvider;
use Magento\OfflineShipping\Model\ResourceModel\Carrier\Tablerate\CollectionFactory;

/**
 * Data provider for the shipping table rates UI form
 */
class FormDataProvider extends ModifierPoolDataProvider
{
    /**
     * @var array|null
     */
    private $formData = null;

    /**
     * @param $name
     * @param $primaryFieldName
     * @param $requestFieldName
     * @param CollectionFactory $collectionFactory
     * @param array $meta
     * @param array $data
     * @param PoolInterface|null $pool
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = [],
        PoolInterface $pool = null
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data, $pool);
        $this->collection = $collectionFactory->create();
    }

    /**
     * Get Data for the Table Shipping Rates UI form
     *
     * @return array|null
     */
    public function getData(): ?array
    {
        if (null !== $this->formData) {
            return $this->formData;
        }

        $items = $this->collection->getItems();
        foreach ($items as $tableRate) {
            $this->formData[$tableRate->getData('pk')] = $tableRate->getData();
        }

        return $this->formData;
    }
}
