<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Megaorson\ProductBadges\Controller\Adminhtml;

use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\ForwardFactory;
use Magento\Catalog\Model\ImageUploader;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Megaorson\ProductBadges\Model\ProductBadgesFactory;

abstract class ProductBadges extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'Megaorson_ProductBadges::top_level';

    /**
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry;

    /**
     * @var \Megaorson\ProductBadges\Model\ProductBadgesFactory
     */
    protected $productBadgesFactory;

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var \Magento\Backend\Model\View\Result\ForwardFactory
     */
    protected $resultForwardFactory;

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var ImageUploader
     */
    protected $imageUploader;

    /**
     * @param ForwardFactory $resultForwardFactory
     * @param PageFactory $resultPageFactory
     * @param ProductBadgesFactory $productBadgesFactory
     * @param Context $context
     * @param Registry $coreRegistry
     */
    public function __construct(
        \Magento\Catalog\Model\ImageUploader $imageUploader,
        \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor,
        \Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Megaorson\ProductBadges\Model\ProductBadgesFactory $productBadgesFactory,
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry
    ) {
        $this->resultForwardFactory = $resultForwardFactory;
        $this->productBadgesFactory = $productBadgesFactory;
        $this->resultPageFactory = $resultPageFactory;
        $this->imageUploader = $imageUploader;
        $this->dataPersistor = $dataPersistor;
        $this->_coreRegistry = $coreRegistry;
        parent::__construct($context);
    }

    /**
     * Init page
     *
     * @param \Magento\Backend\Model\View\Result\Page $resultPage
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function initPage($resultPage)
    {
        $resultPage->setActiveMenu(self::ADMIN_RESOURCE)
            ->addBreadcrumb(__('Megaorson'), __('Megaorson'))
            ->addBreadcrumb(__('Productbadges'), __('Productbadges'));
        return $resultPage;
    }
}
