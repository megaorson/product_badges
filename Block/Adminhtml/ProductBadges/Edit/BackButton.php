<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Megaorson\ProductBadges\Block\Adminhtml\ProductBadges\Edit;

use Magento\Backend\Block\Widget\Context;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class BackButton extends GenericButton implements ButtonProviderInterface
{
    /**
     * @var \Megaorson\ProductBadges\Model\ProductBadgesFactory
     */
    protected $productBadgesFactory;

    /**
     * @param \Megaorson\ProductBadges\Model\ProductBadgesFactory $productBadgesFactory
     * @param Context $context
     */
    public function __construct(
        \Megaorson\ProductBadges\Model\ProductBadgesFactory $productBadgesFactory,
        Context $context
    ) {
        parent::__construct($context);
        $this->productBadgesFactory = $productBadgesFactory;
    }

    /**
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label' => __('Back'),
            'on_click' => sprintf("location.href = '%s';", $this->getBackUrl()),
            'class' => 'back',
            'sort_order' => 10
        ];
    }

    /**
     * Get URL for back (reset) button
     *
     * @return string
     */
    public function getBackUrl()
    {
        $model = $this->productBadgesFactory->create()->load($this->getModelId());
        return $this->getUrl('catalog/product/edit', [
            'id' => $model->getData('product_id'),
        ]);
    }
}

