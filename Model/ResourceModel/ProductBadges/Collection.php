<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Megaorson\ProductBadges\Model\ResourceModel\ProductBadges;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    /**
     * @inheritDoc
     */
    protected $_idFieldName = 'productbadges_id';

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(
            \Megaorson\ProductBadges\Model\ProductBadges::class,
            \Megaorson\ProductBadges\Model\ResourceModel\ProductBadges::class
        );
    }
}

