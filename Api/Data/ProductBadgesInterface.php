<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Megaorson\ProductBadges\Api\Data;

interface ProductBadgesInterface
{

    const PRODUCTBADGES_ID = 'productbadges_id';
    const PRODUCT_ID = 'product_id';
    const IS_VISIBLE_PDP = 'is_visible_pdp';
    const IS_VISIBLE_PLP = 'is_visible_plp';
    const IMAGE = 'image';
    const LABEL = 'label';

    /**
     * Get productbadges_id
     * @return string|null
     */
    public function getProductbadgesId();

    /**
     * Set productbadges_id
     * @param string $productbadgesId
     * @return \Megaorson\ProductBadges\ProductBadges\Api\Data\ProductBadgesInterface
     */
    public function setProductbadgesId($productbadgesId);

    /**
     * Get label
     * @return string|null
     */
    public function getLabel();

    /**
     * Set label
     * @param string $label
     * @return \Megaorson\ProductBadges\ProductBadges\Api\Data\ProductBadgesInterface
     */
    public function setLabel($label);

    /**
     * Get image
     * @return string|null
     */
    public function getImage();

    /**
     * Set image
     * @param string $image
     * @return \Megaorson\ProductBadges\ProductBadges\Api\Data\ProductBadgesInterface
     */
    public function setImage($image);

    /**
     * Get is_visible_pdp
     * @return string|null
     */
    public function getIsVisiblePdp();

    /**
     * Set is_visible_pdp
     * @param string $isVisiblePdp
     * @return \Megaorson\ProductBadges\ProductBadges\Api\Data\ProductBadgesInterface
     */
    public function setIsVisiblePdp($isVisiblePdp);

    /**
     * Get is_visible_plp
     * @return string|null
     */
    public function getIsVisiblePlp();

    /**
     * Set is_visible_plp
     * @param string $isVisiblePlp
     * @return \Megaorson\ProductBadges\ProductBadges\Api\Data\ProductBadgesInterface
     */
    public function setIsVisiblePlp($isVisiblePlp);

    /**
     * Get product_id
     * @return string|null
     */
    public function getProductId();

    /**
     * Set product_id
     * @param string $productId
     * @return \Megaorson\ProductBadges\ProductBadges\Api\Data\ProductBadgesInterface
     */
    public function setProductId($productId);
}

