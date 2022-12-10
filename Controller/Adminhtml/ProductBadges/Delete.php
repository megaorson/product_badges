<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Megaorson\ProductBadges\Controller\Adminhtml\ProductBadges;

class Delete extends \Megaorson\ProductBadges\Controller\Adminhtml\ProductBadges
{
    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        // check if we know what should be deleted
        $id = $this->getRequest()->getParam('productbadges_id');
        if ($id) {
            try {
                // init model and delete
                $model = $this->productBadgesFactory->create();
                $model->load($id);
                $model->delete();
                // display success message
                $this->messageManager->addSuccessMessage(__('You deleted the Productbadges.'));
                // go to grid
                return $resultRedirect->setPath('catalog/product/edit', [
                    'id' => $model->getData('product_id')
                ]);
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addErrorMessage($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['productbadges_id' => $id]);
            }
        }
        // display error message
        $this->messageManager->addErrorMessage(__('We can\'t find a Productbadges to delete.'));
        // go to grid
        return $resultRedirect->setPath('*/*/');
    }
}

