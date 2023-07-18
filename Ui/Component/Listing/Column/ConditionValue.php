<?php
/**
 * @author Developers-Alliance team
 * @copyright Copyright (c) 2023 Developers-alliance (https://www.developers-alliance.com)
 * @package Shipping Table Rates for Magento 2
 */

declare(strict_types=1);

namespace DevAll\TableRates\Ui\Component\Listing\Column;

use Magento\Ui\Component\Listing\Columns\Column;

/**
 * Class ConditionValue
 *
 * UiComponent class for Condition value column
 */
class ConditionValue extends Column
{

    /**
     * Prepare Data Source
     * Extended for formatting decimal output
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource): array
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                $item[$this->getData('name')] = number_format(
                    (float)$item[$this->getData('name')], 2, '.', ''
                );
            }
        }

        return $dataSource;
    }
}
