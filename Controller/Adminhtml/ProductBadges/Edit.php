<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Megaorson\ProductBadges\Controller\Adminhtml\ProductBadges;

class Edit extends \Megaorson\ProductBadges\Controller\Adminhtml\ProductBadges
{
    /**
     * Edit action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        // 1. Get ID and create model
        $id = $this->getRequest()->getParam('productbadges_id');
        $model = $this->productBadgesFactory->create();

        // 2. Initial checking
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addErrorMessage(__('This Productbadges no longer exists.'));
                /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }
        $this->_coreRegistry->register('megaorson_productbadges_productbadges', $model);

        // 3. Build edit form
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $this->initPage($resultPage)->addBreadcrumb(
            $id ? __('Edit Productbadges') : __('New Productbadges'),
            $id ? __('Edit Productbadges') : __('New Productbadges')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Productbadgess'));
        $resultPage->getConfig()->getTitle()->prepend($model->getId() ? __('Edit Productbadges %1', $model->getId()) : __('New Productbadges'));
        return $resultPage;
    }
}
