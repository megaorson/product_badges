<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Megaorson\ProductBadges\Model;

use Magento\Framework\Model\AbstractModel;
use Megaorson\ProductBadges\Api\Data\ProductBadgesInterface;

class ProductBadges extends AbstractModel implements ProductBadgesInterface
{

    /**
     * @inheritDoc
     */
    public function _construct()
    {
        $this->_init(\Megaorson\ProductBadges\Model\ResourceModel\ProductBadges::class);
    }

    /**
     * @inheritDoc
     */
    public function getProductbadgesId()
    {
        return $this->getData(self::PRODUCTBADGES_ID);
    }

    /**
     * @inheritDoc
     */
    public function setProductbadgesId($productbadgesId)
    {
        return $this->setData(self::PRODUCTBADGES_ID, $productbadgesId);
    }

    /**
     * @inheritDoc
     */
    public function getLabel()
    {
        return $this->getData(self::LABEL);
    }

    /**
     * @inheritDoc
     */
    public function setLabel($label)
    {
        return $this->setData(self::LABEL, $label);
    }

    /**
     * @inheritDoc
     */
    public function getImage()
    {
        return $this->getData(self::IMAGE);
    }

    /**
     * @inheritDoc
     */
    public function setImage($image)
    {
        return $this->setData(self::IMAGE, $image);
    }

    /**
     * @inheritDoc
     */
    public function getIsVisiblePdp()
    {
        return $this->getData(self::IS_VISIBLE_PDP);
    }

    /**
     * @inheritDoc
     */
    public function setIsVisiblePdp($isVisiblePdp)
    {
        return $this->setData(self::IS_VISIBLE_PDP, $isVisiblePdp);
    }

    /**
     * @inheritDoc
     */
    public function getIsVisiblePlp()
    {
        return $this->getData(self::IS_VISIBLE_PLP);
    }

    /**
     * @inheritDoc
     */
    public function setIsVisiblePlp($isVisiblePlp)
    {
        return $this->setData(self::IS_VISIBLE_PLP, $isVisiblePlp);
    }

    /**
     * @inheritDoc
     */
    public function getProductId()
    {
        return $this->getData(self::PRODUCT_ID);
    }

    /**
     * @inheritDoc
     */
    public function setProductId($productId)
    {
        return $this->setData(self::PRODUCT_ID, $productId);
    }
}

