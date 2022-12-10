<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Megaorson\ProductBadges\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface ProductBadgesRepositoryInterface
{

    /**
     * Save ProductBadges
     * @param \Megaorson\ProductBadges\Api\Data\ProductBadgesInterface $productBadges
     * @return \Megaorson\ProductBadges\Api\Data\ProductBadgesInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Megaorson\ProductBadges\Api\Data\ProductBadgesInterface $productBadges
    );

    /**
     * Retrieve ProductBadges
     * @param string $productbadgesId
     * @return \Megaorson\ProductBadges\Api\Data\ProductBadgesInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($productbadgesId);

    /**
     * Retrieve ProductBadges matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Megaorson\ProductBadges\Api\Data\ProductBadgesSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete ProductBadges
     * @param \Megaorson\ProductBadges\Api\Data\ProductBadgesInterface $productBadges
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Megaorson\ProductBadges\Api\Data\ProductBadgesInterface $productBadges
    );

    /**
     * Delete ProductBadges by ID
     * @param string $productbadgesId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($productbadgesId);
}

