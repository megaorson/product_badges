<?php

namespace Megaorson\ProductBadges\Block\Product\View;

use Megaorson\ProductBadges\Block\AbstractBadges;
use Megaorson\ProductBadges\Model\ProductBadgesFactory;
use Megaorson\ProductBadges\Model\ResourceModel\ProductBadges\CollectionFactory;

class GalleryPlugin extends AbstractBadges
{
    /**
     *
     * @param \Magento\Catalog\Block\Product\View\Gallery $gallery
     * @param $response
     * @return mixed
     */
    public function afterToHtml(
        \Magento\Catalog\Block\Product\View\Gallery $gallery,
        $response
    ) {
        return $response . $this->_getHtml($gallery->getProduct()->getId());
    }
}
