<?php


namespace Tesarjar\Catheader\Controller\Adminhtml\Catheader;

/**
 * Class Edit
 *
 * @package Tesarjar\Catheader\Controller\Adminhtml\Catheader
 */
class Edit extends \Tesarjar\Catheader\Controller\Adminhtml\Catheader
{

    protected $resultPageFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context, $coreRegistry);
    }

    /**
     * Edit action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        // 1. Get ID and create model
        $id = $this->getRequest()->getParam('catheader_id');
        $model = $this->_objectManager->create(\Tesarjar\Catheader\Model\Catheader::class);
        
        // 2. Initial checking
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addErrorMessage(__('This Catheader no longer exists.'));
                /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }
        $this->_coreRegistry->register('tesarjar_catheader_catheader', $model);
        
        // 3. Build edit form
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $this->initPage($resultPage)->addBreadcrumb(
            $id ? __('Edit Catheader') : __('New Catheader'),
            $id ? __('Edit Catheader') : __('New Catheader')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Catheaders'));
        $resultPage->getConfig()->getTitle()->prepend($model->getId() ? __('Edit Catheader %1', $model->getId()) : __('New Catheader'));
        return $resultPage;
    }
}

