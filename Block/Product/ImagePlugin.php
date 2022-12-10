<?php

namespace Megaorson\ProductBadges\Block\Product;

use Megaorson\ProductBadges\Block\AbstractBadges;

class ImagePlugin extends AbstractBadges
{
    /**
     * @param \Magento\Catalog\Block\Product\Image $image
     * @param $response
     * @return string
     */
    public function afterToHtml(
        \Magento\Catalog\Block\Product\Image $image,
        $response
    ) {
        $this->isCheckLoad = false;
        $this->filterField = 'is_visible_plp';
        return $response . $this->_getHtml($image->getData('product_id'));
    }
}
