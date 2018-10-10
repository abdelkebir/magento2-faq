<?php
namespace Godogi\Faq\Controller\Adminhtml\Qa;

use Godogi\Faq\Controller\Adminhtml\Qa;

class Edit extends Qa
{
	/**
	* @return void
	*/
	public function execute()
	{
		$qaId = $this->getRequest()->getParam('qa_id');
		/** @var \Godogi\Faq\Model\Qa $model */
		$model = $this->_qaFactory->create();
		if ($qaId) {
			$model->load($qaId);
			if (!$model->getId()) {
				$this->messageManager->addError(__('This qa no longer exists.'));
				$this->_redirect('*/*/');
				return;
			}
		}
		// Restore previously entered form data from session
		$data = $this->_session->getQaData(true);
		if (!empty($data)) {
			$model->setData($data);
		}
		$this->_coreRegistry->register('godogi_faq_qa', $model);
		/** @var \Magento\Backend\Model\View\Result\Page $resultPage */
		$resultPage = $this->_resultPageFactory->create();
		$resultPage->setActiveMenu('Godogi_Faq::content_faq');
		$resultPage->getConfig()->getTitle()->prepend(__('Qa'));
		return $resultPage;
	}
}