<?php
/**
 * @author Developers-Alliance team
 * @copyright Copyright (c) 2023 Developers-alliance (https://www.developers-alliance.com)
 * @package Shipping Table Rates for Magento 2
 */

declare(strict_types=1);

namespace DevAll\TableRates\Controller\Adminhtml\Actions;

use DevAll\TableRates\Api\Data\TablerateInterface;
use DevAll\TableRates\Api\TablerateRepositoryInterface;
use DevAll\TableRates\Controller\Adminhtml\View\Grid;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\Result\RedirectFactory;
use Psr\Log\LoggerInterface;

/**
 * Action for removing single table rate record
 */
class Delete extends Action implements HttpPostActionInterface
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    public const ADMIN_RESOURCE = 'DevAll_TableRates::management';

    /**
     * @var RedirectFactory
     */
    private $redirect;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var TablerateRepositoryInterface
     */
    private $tablerateRepository;

    /**
     * @param Context $context
     * @param RedirectFactory $redirect
     * @param LoggerInterface $logger
     * @param TablerateRepositoryInterface $tablerateRepository
     */
    public function __construct(
        Action\Context $context,
        RedirectFactory $redirect,
        LoggerInterface $logger,
        TablerateRepositoryInterface $tablerateRepository
    ) {
        parent::__construct($context);
        $this->redirect = $redirect;
        $this->logger = $logger;
        $this->tablerateRepository = $tablerateRepository;
    }

    /**
     * Delete shipping table rate
     *
     * @return Redirect
     */
    public function execute(): Redirect
    {
        $resultRedirect = $this->redirect->create();
        $pk = $this->getRequest()->getParam(TablerateInterface::PK, false);

        if ($pk !== null) {
            try {
                $this->tablerateRepository->deleteByPk((int)$pk);
                $this->messageManager->addSuccessMessage(
                    __('Shipping table rate(s) with id: %1 - removed.', $pk)
                );
            } catch (\Throwable $e) {
                $this->logger->error($e->getMessage());
                $this->messageManager->addErrorMessage(__($e->getMessage()));
            }
        }

        return $resultRedirect->setPath(Grid::PATH);
    }
}
