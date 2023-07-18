<?php
/**
 * @author Developers-Alliance team
 * @copyright Copyright (c) 2023 Developers-alliance (https://www.developers-alliance.com)
 * @package Shipping Table Rates for Magento 2
 */

declare(strict_types=1);

namespace DevAll\TableRates\Controller\Adminhtml\View;

use Magento\Backend\App\Action;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;

/**
 * Listing page action for the table rates
 */
class Grid extends Action implements HttpGetActionInterface
{
    /**
     * Path to the page returned by this action
     */
    public const PATH = 'tablerates/view/grid';

    /**
     * Authorization level of a basic admin session
     */
    public const ADMIN_RESOURCE = 'DevAll_TableRates::view';

    /**
     * Execute action return result and set page title
     *
     * @return ResultInterface
     */
    public function execute(): ResultInterface
    {
        $result = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $result->getConfig()->getTitle()->prepend(__('Shipping Table Rates'));

        return $result;
    }
}
