<?php
namespace Godogi\Faq\Controller\Adminhtml\Qa;

use Godogi\Faq\Controller\Adminhtml\Qa;

class Save extends Qa
{
	/**
	* @return void
	*/
	public function execute()
	{
		$isPost = $this->getRequest()->getPost();
		if ($isPost) {
			$qaModel = $this->_qaFactory->create();
			$qaId = $this->getRequest()->getParam('qa_id');
			if ($qaId) {
				$qaModel->load($qaId);
			}
			$formData = $this->getRequest()->getParam('qa');
			$qaModel->setData($formData);
			try {
				// Save news
				$qaModel->save();
				// Display success message
				$this->messageManager->addSuccess(__('The qa has been saved.'));
				// Check if 'Save and Continue'
				if ($this->getRequest()->getParam('back')) {
					$this->_redirect('*/*/edit', ['qa_id' => $qaModel->getQaId(), '_current' => true]);
					return;
				}
				// Go to grid page
				$this->_redirect('*/*/');
				return;
			} catch (\Exception $e) {
				$this->messageManager->addError($e->getMessage());
			}
			$this->_getSession()->setFormData($formData);
			$this->_redirect('*/*/edit', ['qa_id' => $qaId]);
		}
	}
}