<?php


namespace Tesarjar\Catheader\Controller\Adminhtml\Catheader;

/**
 * Class Delete
 *
 * @package Tesarjar\Catheader\Controller\Adminhtml\Catheader
 */
class Delete extends \Tesarjar\Catheader\Controller\Adminhtml\Catheader
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
        $id = $this->getRequest()->getParam('catheader_id');
        if ($id) {
            try {
                // init model and delete
                $model = $this->_objectManager->create(\Tesarjar\Catheader\Model\Catheader::class);
                $model->load($id);
                $model->delete();
                // display success message
                $this->messageManager->addSuccessMessage(__('You deleted the Catheader.'));
                // go to grid
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addErrorMessage($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['catheader_id' => $id]);
            }
        }
        // display error message
        $this->messageManager->addErrorMessage(__('We can\'t find a Catheader to delete.'));
        // go to grid
        return $resultRedirect->setPath('*/*/');
    }
}

