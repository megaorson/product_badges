<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Megaorson\ProductBadges\Api\Data;

interface ProductBadgesSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get ProductBadges list.
     * @return \Megaorson\ProductBadges\Api\Data\ProductBadgesInterface[]
     */
    public function getItems();

    /**
     * Set label list.
     * @param \Megaorson\ProductBadges\Api\Data\ProductBadgesInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

