<?php
/**
 * @author Developers-Alliance team
 * @copyright Copyright (c) 2023 Developers-alliance (https://www.developers-alliance.com)
 * @package Shipping Table Rates for Magento 2
 */

declare(strict_types=1);

namespace DevAll\TableRates\Model;

use DevAll\TableRates\Api\Data\TablerateInterface;
use Magento\OfflineShipping\Model\ResourceModel\Carrier\Tablerate as ResourceModel;
use Magento\Framework\Model\AbstractModel;

/**
 * Custom Tablerate model
 * Default model extends AbstractCarrier instead of the AbstractModel
 * Therefore can't be used for the basic CRUD operations necessary for the grid management
 */
class Tablerate extends AbstractModel implements TablerateInterface
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'devall_shipping_tablerate_model';

    /**
     * Initialize magento model.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }

    /**
     * Getter for Pk.
     *
     * @return int|null
     */
    public function getPk(): ?int
    {
        return $this->getData(self::PK) === null ? null
            : (int)$this->getData(self::PK);
    }

    /**
     * Setter for Pk.
     *
     * @param int|null $pk
     *
     * @return void
     */
    public function setPk(?int $pk): void
    {
        $this->setData(self::PK, $pk);
    }

    /**
     * Getter for WebsiteId.
     *
     * @return int|null
     */
    public function getWebsiteId(): ?int
    {
        return $this->getData(self::WEBSITE_ID) === null ? null
            : (int)$this->getData(self::WEBSITE_ID);
    }

    /**
     * Setter for WebsiteId.
     *
     * @param int|null $websiteId
     *
     * @return void
     */
    public function setWebsiteId(?int $websiteId): void
    {
        $this->setData(self::WEBSITE_ID, $websiteId);
    }

    /**
     * Getter for DestCountryId.
     *
     * @return string|null
     */
    public function getDestCountryId(): ?string
    {
        return $this->getData(self::DEST_COUNTRY_ID);
    }

    /**
     * Setter for DestCountryId.
     *
     * @param string|null $destCountryId
     *
     * @return void
     */
    public function setDestCountryId(?string $destCountryId): void
    {
        $this->setData(self::DEST_COUNTRY_ID, $destCountryId);
    }

    /**
     * Getter for DestRegionId.
     *
     * @return int|null
     */
    public function getDestRegionId(): ?int
    {
        return $this->getData(self::DEST_REGION_ID) === null ? null
            : (int)$this->getData(self::DEST_REGION_ID);
    }

    /**
     * Setter for DestRegionId.
     *
     * @param int|null $destRegionId
     *
     * @return void
     */
    public function setDestRegionId(?int $destRegionId): void
    {
        $this->setData(self::DEST_REGION_ID, $destRegionId);
    }

    /**
     * Getter for DestZip.
     *
     * @return string|null
     */
    public function getDestZip(): ?string
    {
        return $this->getData(self::DEST_ZIP);
    }

    /**
     * Setter for DestZip.
     *
     * @param string|null $destZip
     *
     * @return void
     */
    public function setDestZip(?string $destZip): void
    {
        $this->setData(self::DEST_ZIP, $destZip);
    }

    /**
     * Getter for ConditionName.
     *
     * @return string|null
     */
    public function getConditionName(): ?string
    {
        return $this->getData(self::CONDITION_NAME);
    }

    /**
     * Setter for ConditionName.
     *
     * @param string|null $conditionName
     *
     * @return void
     */
    public function setConditionName(?string $conditionName): void
    {
        $this->setData(self::CONDITION_NAME, $conditionName);
    }

    /**
     * Getter for ConditionValue.
     *
     * @return float|null
     */
    public function getConditionValue(): ?float
    {
        return $this->getData(self::CONDITION_VALUE) === null ? null
            : (float)$this->getData(self::CONDITION_VALUE);
    }

    /**
     * Setter for ConditionValue.
     *
     * @param float|null $conditionValue
     *
     * @return void
     */
    public function setConditionValue(?float $conditionValue): void
    {
        $this->setData(self::CONDITION_VALUE, $conditionValue);
    }

    /**
     * Getter for Price.
     *
     * @return float|null
     */
    public function getPrice(): ?float
    {
        return $this->getData(self::PRICE) === null ? null
            : (float)$this->getData(self::PRICE);
    }

    /**
     * Setter for Price.
     *
     * @param float|null $price
     *
     * @return void
     */
    public function setPrice(?float $price): void
    {
        $this->setData(self::PRICE, $price);
    }
}
