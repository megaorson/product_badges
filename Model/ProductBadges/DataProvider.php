<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Megaorson\ProductBadges\Model\ProductBadges;

use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\UrlInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Ui\DataProvider\AbstractDataProvider;
use Megaorson\ProductBadges\Model\ResourceModel\ProductBadges\CollectionFactory;

class DataProvider extends AbstractDataProvider
{

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var array
     */
    protected $loadedData;
    /**
     * @inheritDoc
     */
    protected $collection;

    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * @var StoreManagerInterface
     */
    protected $storeManger;

    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $collectionFactory
     * @param DataPersistorInterface $dataPersistor
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        StoreManagerInterface $storeManager,
        RequestInterface $request,
        CollectionFactory $collectionFactory,
        DataPersistorInterface $dataPersistor,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory->create();
        $this->storeManger = $storeManager;
        $this->request = $request;
        $this->dataPersistor = $dataPersistor;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * @inheritDoc
     */
    public function getData()
    {
        $baseurl =  $this->storeManger->getStore()->getBaseUrl(UrlInterface::URL_TYPE_MEDIA);

        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        foreach ($items as $model) {
            $dataModel = $model->getData();
            if (isset($dataModel['image'])) {
                $img = [];
                $img[0]['name'] = $dataModel['image'];
                $img[0]['is_old'] = true;
                $img[0]['url'] = $baseurl . 'badge/image/' . $dataModel['image'];
                $dataModel['image'] = $img;
            }

            $this->loadedData[$model->getId()] = $dataModel;
        }

        $data = $this->dataPersistor->get('megaorson_productbadges_productbadges');
        $data['product_id'] = $this->request->getParam('product_id');
        if (isset($data['image'])) {
            $img = [];
            $img[0]['name'] = $data['image'];
            $img[0]['is_old'] = true;
            $img[0]['url'] = $baseurl . 'badge/image/' . $data['image'];
            $data['image'] = $img;
        }

        if (!empty($data)) {
            $model = $this->collection->getNewEmptyItem();
            $model->setData($data);
            $this->loadedData[$model->getId()] = $model->getData();
            $this->dataPersistor->clear('megaorson_productbadges_productbadges');
        }

        return $this->loadedData;
    }
}
