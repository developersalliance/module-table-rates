<?php
/**
 * @author Developers-Alliance team
 * @copyright Copyright (c) 2023 Developers-alliance (https://www.developers-alliance.com)
 * @package Shipping Table Rates for Magento 2
 */

declare(strict_types=1);

namespace DevAll\TableRates\Api\Data;

/**
 * Interface for Tablerate model
 */
interface TablerateInterface
{
    /**
     * String constants for property names
     */
    public const PK = "pk";
    public const WEBSITE_ID = "website_id";
    public const DEST_COUNTRY_ID = "dest_country_id";
    public const DEST_REGION_ID = "dest_region_id";
    public const DEST_ZIP = "dest_zip";
    public const CONDITION_NAME = "condition_name";
    public const CONDITION_VALUE = "condition_value";
    public const PRICE = "price";

    /**
     * Name for the shipping table rates table
     */
    public const TABLE_RATES_TABLE_NAME = "shipping_tablerate";

    /**
     * Getter for Pk.
     *
     * @return int|null
     */
    public function getPk(): ?int;

    /**
     * Setter for Pk.
     *
     * @param int|null $pk
     *
     * @return void
     */
    public function setPk(?int $pk): void;

    /**
     * Getter for WebsiteId.
     *
     * @return int|null
     */
    public function getWebsiteId(): ?int;

    /**
     * Setter for WebsiteId.
     *
     * @param int|null $websiteId
     *
     * @return void
     */
    public function setWebsiteId(?int $websiteId): void;

    /**
     * Getter for DestCountryId.
     *
     * @return string|null
     */
    public function getDestCountryId(): ?string;

    /**
     * Setter for DestCountryId.
     *
     * @param string|null $destCountryId
     *
     * @return void
     */
    public function setDestCountryId(?string $destCountryId): void;

    /**
     * Getter for DestRegionId.
     *
     * @return int|null
     */
    public function getDestRegionId(): ?int;

    /**
     * Setter for DestRegionId.
     *
     * @param int|null $destRegionId
     *
     * @return void
     */
    public function setDestRegionId(?int $destRegionId): void;

    /**
     * Getter for DestZip.
     *
     * @return string|null
     */
    public function getDestZip(): ?string;

    /**
     * Setter for DestZip.
     *
     * @param string|null $destZip
     *
     * @return void
     */
    public function setDestZip(?string $destZip): void;

    /**
     * Getter for ConditionName.
     *
     * @return string|null
     */
    public function getConditionName(): ?string;

    /**
     * Setter for ConditionName.
     *
     * @param string|null $conditionName
     *
     * @return void
     */
    public function setConditionName(?string $conditionName): void;

    /**
     * Getter for ConditionValue.
     *
     * @return float|null
     */
    public function getConditionValue(): ?float;

    /**
     * Setter for ConditionValue.
     *
     * @param float|null $conditionValue
     *
     * @return void
     */
    public function setConditionValue(?float $conditionValue): void;

    /**
     * Getter for Price.
     *
     * @return float|null
     */
    public function getPrice(): ?float;

    /**
     * Setter for Price.
     *
     * @param float|null $price
     *
     * @return void
     */
    public function setPrice(?float $price): void;
}
