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
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultFactory;

/**
 * Action for Saving new and existing table rates
 */
class Save extends Action implements HttpPostActionInterface
{
    /**
     * Authorization level of a basic admin session
     *
     * @see MassDelete::_isAllowed()
     */
    public const ADMIN_RESOURCE = 'DevAll_TableRates::management';

    /**
     * @var TablerateRepositoryInterface
     */
    private $tablerateRepository;

    /**
     * @param Context $context
     * @param TablerateRepositoryInterface $tablerateRepository
     */
    public function __construct(
        Context $context,
        TablerateRepositoryInterface $tablerateRepository
    ) {
        parent::__construct($context);
        $this->tablerateRepository = $tablerateRepository;
    }

    /**
     * Save table rate
     *
     * @return Redirect
     */
    public function execute(): Redirect
    {
        $params = $this->getRequest()->getParams();
        try {
            $this->tablerateRepository->saveFromArray($params);
        } catch (\Throwable $e) {
            $this->messageManager->addErrorMessage(__($e->getMessage()));
        }

        /** @var Redirect $redirect */
        $redirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $redirect->setPath(Grid::PATH);
        $this->messageManager->addSuccessMessage(__('Table Rate was successfully saved.'));

        return $redirect;
    }
}
