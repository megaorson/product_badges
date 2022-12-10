<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Megaorson\ProductBadges\Model;

use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Megaorson\ProductBadges\Api\Data\ProductBadgesInterface;
use Megaorson\ProductBadges\Api\Data\ProductBadgesInterfaceFactory;
use Megaorson\ProductBadges\Api\Data\ProductBadgesSearchResultsInterfaceFactory;
use Megaorson\ProductBadges\Api\ProductBadgesRepositoryInterface;
use Megaorson\ProductBadges\Model\ResourceModel\ProductBadges as ResourceProductBadges;
use Megaorson\ProductBadges\Model\ResourceModel\ProductBadges\CollectionFactory as ProductBadgesCollectionFactory;

class ProductBadgesRepository implements ProductBadgesRepositoryInterface
{

    /**
     * @var ResourceProductBadges
     */
    protected $resource;

    /**
     * @var ProductBadges
     */
    protected $searchResultsFactory;

    /**
     * @var ProductBadgesInterfaceFactory
     */
    protected $productBadgesFactory;

    /**
     * @var CollectionProcessorInterface
     */
    protected $collectionProcessor;

    /**
     * @var ProductBadgesCollectionFactory
     */
    protected $productBadgesCollectionFactory;


    /**
     * @param ResourceProductBadges $resource
     * @param ProductBadgesInterfaceFactory $productBadgesFactory
     * @param ProductBadgesCollectionFactory $productBadgesCollectionFactory
     * @param ProductBadgesSearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        ResourceProductBadges $resource,
        ProductBadgesInterfaceFactory $productBadgesFactory,
        ProductBadgesCollectionFactory $productBadgesCollectionFactory,
        ProductBadgesSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->resource = $resource;
        $this->productBadgesFactory = $productBadgesFactory;
        $this->productBadgesCollectionFactory = $productBadgesCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @inheritDoc
     */
    public function save(ProductBadgesInterface $productBadges)
    {
        try {
            $this->resource->save($productBadges);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the productBadges: %1',
                $exception->getMessage()
            ));
        }
        return $productBadges;
    }

    /**
     * @inheritDoc
     */
    public function get($productBadgesId)
    {
        $productBadges = $this->productBadgesFactory->create();
        $this->resource->load($productBadges, $productBadgesId);
        if (!$productBadges->getId()) {
            throw new NoSuchEntityException(__('ProductBadges with id "%1" does not exist.', $productBadgesId));
        }
        return $productBadges;
    }

    /**
     * @inheritDoc
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->productBadgesCollectionFactory->create();
        
        $this->collectionProcessor->process($criteria, $collection);
        
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        
        $items = [];
        foreach ($collection as $model) {
            $items[] = $model;
        }
        
        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * @inheritDoc
     */
    public function delete(ProductBadgesInterface $productBadges)
    {
        try {
            $productBadgesModel = $this->productBadgesFactory->create();
            $this->resource->load($productBadgesModel, $productBadges->getProductbadgesId());
            $this->resource->delete($productBadgesModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the ProductBadges: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * @inheritDoc
     */
    public function deleteById($productBadgesId)
    {
        return $this->delete($this->get($productBadgesId));
    }
}

