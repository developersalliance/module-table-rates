<?php
declare(strict_types=1);
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace DevAll\TableRates\Ui\Component\Listing\Column\Source;

use Magento\Directory\Model\ResourceModel\Region\CollectionFactory;
use Magento\Framework\Data\OptionSourceInterface;

/**
 * Class for process countries in customer addresses grid
 */
class Region implements OptionSourceInterface
{
    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    /**
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        CollectionFactory $collectionFactory
    ) {
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * Get list of countries with country id as value and code as label
     *
     * @return array
     */
    public function toOptionArray(): array
    {
        $countryCollection = $this->collectionFactory->create();
        return $countryCollection->toOptionArray();
    }
}
