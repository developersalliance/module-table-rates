<?php
/**
 * @author Developers-Alliance team
 * @copyright Copyright (c) 2023 Developers-alliance (https://www.developers-alliance.com)
 * @package Shipping Table Rates for Magento 2
 */

declare(strict_types=1);

namespace DevAll\TableRates\Controller\Adminhtml\Actions;

use DevAll\TableRates\Api\TablerateRepositoryInterface;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\Json;
use Magento\Framework\Controller\Result\JsonFactory;

/**
 * Action for inline editing table rates in the grid
 */
class InlineEdit extends Action
{
    /**
     * @var JsonFactory
     */
    private $jsonFactory;

    /**
     * @var TablerateRepositoryInterface
     */
    private $tablerateRepository;

    /**
     * @param Context $context
     * @param JsonFactory $jsonFactory
     * @param TablerateRepositoryInterface $tablerateRepository
     */
    public function __construct(
        Context $context,
        JsonFactory $jsonFactory,
        TablerateRepositoryInterface $tablerateRepository
    ) {
        parent::__construct($context);
        $this->jsonFactory = $jsonFactory;
        $this->tablerateRepository = $tablerateRepository;
    }

    /**
     * Handle Edit table rate async request
     *
     * @return Json
     */
    public function execute(): Json
    {
        $resultJson = $this->jsonFactory->create();
        $error = false;
        $messages = [];

        if ($this->getRequest()->getParam('isAjax')) {
            $postItems = $this->getRequest()->getParam('items', []);
            if (!count($postItems)) {
                $messages[] = __('Please correct the data sent.');
                $error = true;
            } else {
                foreach ($postItems as $postItem) {
                    try {
                        $this->tablerateRepository->saveFromArray($postItem);
                    } catch (\Throwable $e) {
                        $messages[] = "[Error:]  {$e->getMessage()}";
                        $error = true;
                    }
                }
            }
        }

        return $resultJson->setData([
            'messages' => $messages,
            'error' => $error
        ]);
    }
}
