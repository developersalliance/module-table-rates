<?php
/**
 * @author Developers-Alliance team
 * @copyright Copyright (c) 2023 Developers-alliance (https://www.developers-alliance.com)
 * @package Shipping Table Rates for Magento 2
 */

declare(strict_types=1);

namespace DevAll\TableRates\Controller\Adminhtml\Actions;

use DevAll\TableRates\Api\TablerateRepositoryInterface;
use DevAll\TableRates\Controller\Adminhtml\View\Grid;
use Magento\Backend\App\Action;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\Result\RedirectFactory;
use Magento\Ui\Component\MassAction\Filter;
use Magento\OfflineShipping\Model\ResourceModel\Carrier\Tablerate\CollectionFactory;

/**
 * Action to delete selected shipping table rates through massaction
 */
class MassDelete extends Action implements HttpPostActionInterface
{
    /**
     * Authorization level of a basic admin session
     *
     * @see MassDelete::_isAllowed()
     */
    const ADMIN_RESOURCE = 'DevAll_TableRates::management';

    /**
     * @var CollectionFactory
     */
    public $collectionFactory;

    /**
     * @var Filter
     */
    public $filter;

    /**
     * @var RedirectFactory
     */
    private $redirect;

    /**
     * @var TablerateRepositoryInterface
     */
    private $tablerateRepository;

    /**
     * @param Context $context
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     * @param RedirectFactory $redirect
     * @param TablerateRepositoryInterface $tablerateRepository
     */
    public function __construct(
        Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory,
        RedirectFactory $redirect,
        TablerateRepositoryInterface $tablerateRepository
    ) {
        parent::__construct($context);
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        $this->redirect = $redirect;
        $this->tablerateRepository = $tablerateRepository;
    }

    /**
     * Delete specified shipping table rates using grid massaction
     *
     * @return Redirect
     */
    public function execute(): Redirect
    {
        $resultRedirect = $this->redirect->create();

        try {
            $collection = $this->filter->getCollection($this->collectionFactory->create());
            $count = $collection->count();
            $this->tablerateRepository->deleteByCollection($collection);

            $this->messageManager->addSuccessMessage(
                __('A total of %1 Shipping table rate(s) have been deleted.', $count)
            );
        } catch (\Throwable $e) {
            $this->messageManager->addErrorMessage(__($e->getMessage()));
        }

        return $resultRedirect->setPath(Grid::PATH);
    }
}
