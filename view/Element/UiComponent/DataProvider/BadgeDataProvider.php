<?php

namespace Megaorson\ProductBadges\view\Element\UiComponent\DataProvider;

use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\Search\ReportingInterface;
use Magento\Framework\Api\Search\SearchCriteriaBuilder;
use Magento\Framework\Api\Search\SearchResultInterface;
use Magento\Framework\App\RequestInterface;

class BadgeDataProvider extends \Magento\Framework\View\Element\UiComponent\DataProvider\DataProvider
{
    protected $redirect;

    /**
     * @param $name
     * @param $primaryFieldName
     * @param $requestFieldName
     * @param ReportingInterface $reporting
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param RequestInterface $request
     * @param FilterBuilder $filterBuilder
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        \Magento\Framework\App\Response\RedirectInterface $redirect,
        ReportingInterface $reporting,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        RequestInterface $request,
        FilterBuilder $filterBuilder,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct(
            $name,
            $primaryFieldName,
            $requestFieldName,
            $reporting,
            $searchCriteriaBuilder,
            $request,
            $filterBuilder,
            $meta,
            $data
        );

        $this->redirect = $redirect;
    }

    /**
     * @return array
     */
    public function getData()
    {
        $data = parent::getData();

        return $data;
    }

    /**
     * Returns Search result
     *
     * @return SearchResultInterface
     */
    public function getSearchResult()
    {
        $result = $this->reporting->search($this->getSearchCriteria());
        $productId = $this->request->getParam('product_id', false);
        if ($productId === false) {
            $reference = $this->redirect->getRefererUrl();
            $params = explode('/id/', $reference);
            if (isset($params[1])) {
                $productId = (int)$params[1];
            }
        }

        if ($productId) {
            $result->addFieldToFilter('product_id', $productId);
        }

        return $result;
    }
}
