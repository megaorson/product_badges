<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Megaorson\ProductBadges\Controller\Adminhtml\ProductBadges;

use Magento\Framework\Exception\LocalizedException;
use Megaorson\ProductBadges\Controller\Adminhtml\ProductBadges;

class Save extends ProductBadges
{
    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if ($data) {
            $id = $this->getRequest()->getParam('productbadges_id');

            $model = $this->_objectManager->create(\Megaorson\ProductBadges\Model\ProductBadges::class)->load($id);
            if (!$model->getId() && $id) {
                $this->messageManager->addErrorMessage(__('This Productbadges no longer exists.'));
                return $resultRedirect->setPath('*/*/');
            }

            $model->setData($data);
            $image = $this->getRequest()->getParams('image');
            if (isset($image['image'][0]['is_old']) === false && isset($image['image'][0]['name'])) {
                $image = (string)$image['image'][0]['name'];
                $imageName = $this->imageUploader->moveFileFromTmp($image);
                $model->setData('image', $imageName);
            } else {
                $image = (string)$data['image'][0]['name'];
                $model->setData('image', $image);
            }

            try {
                $model->save();
                $this->messageManager->addSuccessMessage(__('You saved the Productbadges.'));
                $this->dataPersistor->clear('megaorson_productbadges_productbadges');

                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', [
                        'productbadges_id' => $model->getId(),
                        'id' => $data['product_id'],
                    ]);
                }
                return $resultRedirect->setPath('catalog/product/edit', [
                    'id' => $data['product_id']
                ]);
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the Productbadges.'));
            }

            $this->dataPersistor->set('megaorson_productbadges_productbadges', $data);
            return $resultRedirect->setPath('*/*/edit', ['productbadges_id' => $this->getRequest()->getParam('productbadges_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}
