<?php

namespace Megaorson\ProductBadges\Block;

use Magento\Catalog\Model\Product;
use Magento\Framework\UrlInterface;
use Megaorson\ProductBadges\Model\ProductBadgesFactory;
use Megaorson\ProductBadges\Model\ResourceModel\ProductBadges\CollectionFactory;

abstract class AbstractBadges
{
    /**
     * @var ProductBadgesFactory
     */
    protected $productBadgesFactory;

    /**
     * @var \Megaorson\ProductBadges\Model\ResourceModel\ProductBadges\CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @var UrlInterface
     */
    protected $url;

    /**
     * @var bool
     */
    protected $isLoaded = false;

    /**
     * @var bool
     */
    protected $isCheckLoad = true;

    /**
     * @var string
     */
    protected $filterField = 'is_visible_pdp';

    /**
     * @param CollectionFactory $collectionFactory
     * @param ProductBadgesFactory $productBadgesFactory
     */
    public function __construct(
        UrlInterface $url,
        \Megaorson\ProductBadges\Model\ResourceModel\ProductBadges\CollectionFactory $collectionFactory,
        ProductBadgesFactory $productBadgesFactory
    ) {
        $this->url = $url;
        $this->collectionFactory = $collectionFactory;
        $this->productBadgesFactory = $productBadgesFactory;
    }

    /**
     * todo The best way is add this all from extension attribute but I don't have time for it
     * todo add create of block system and view this all on fe, but I alos don't have time
     * todo optiomization
     *
     * @param Product $product
     * @return string
     */
    protected function _getHtml($productId): string
    {
        if ($this->isLoaded === true && $this->isCheckLoad === true) {
            return '';
        }
        $this->isLoaded = true;

        $collection = $this->collectionFactory->create();
        $collection->addFieldToFilter('product_id', $productId);
        $collection->addFieldToFilter($this->filterField, 1);
        $html = '';
        foreach ($collection as $item) {
            $html .= "<img src='" . $this->url->getBaseUrl() . 'media/badge/image/' . $item->getData('image') . "'/>";
        }

        return $html;
    }
}
