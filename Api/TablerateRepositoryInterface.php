<?php
/**
 * @author Developers-Alliance team
 * @copyright Copyright (c) 2023 Developers-alliance (https://www.developers-alliance.com)
 * @package Shipping Table Rates for Magento 2
 */

declare(strict_types=1);

namespace DevAll\TableRates\Api;

use DevAll\TableRates\Model\Tablerate;

/**
 * Tablerate Repository Service Class
 *
 * @api
 */
interface TablerateRepositoryInterface
{
    /**
     * Save table rate form array data
     *
     * @param array $data
     * @return void
     */
    public function saveFromArray(array $data);

    /**
     * Delete table rate by pk
     *
     * @param int $pk
     * @return void
     * @throws \Exception
     */
    public function deleteByPk(int $pk);

    /**
     * Delete table rates from the collection
     *
     * @param $collection
     * @return void
     */
    public function deleteByCollection($collection);

    /**
     * Build Model object from an array
     *
     * @param array $data
     * @return Tablerate
     */
    public function arrayToModelObject(array $data): Tablerate;
}
