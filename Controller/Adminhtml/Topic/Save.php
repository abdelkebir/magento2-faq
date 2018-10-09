<?php
namespace Godogi\Faq\Controller\Adminhtml\Topic;

use Godogi\Faq\Controller\Adminhtml\Topic;

class Save extends Topic
{
	/**
	* @return void
	*/
	public function execute()
	{
		$isPost = $this->getRequest()->getPost();
		if ($isPost) {
			$topicModel = $this->_topicFactory->create();
			$topicId = $this->getRequest()->getParam('topic_id');
			if ($topicId) {
				$topicModel->load($topicId);
			}
			$formData = $this->getRequest()->getParam('topic');
			$topicModel->setData($formData);
			try {
				// Save news
				$topicModel->save();
				// Display success message
				$this->messageManager->addSuccess(__('The topic has been saved.'));
				// Check if 'Save and Continue'
				if ($this->getRequest()->getParam('back')) {
					$this->_redirect('*/*/edit', ['topic_id' => $topicModel->getTopicId(), '_current' => true]);
					return;
				}
				// Go to grid page
				$this->_redirect('*/*/');
				return;
			} catch (\Exception $e) {
				$this->messageManager->addError($e->getMessage());
			}
			$this->_getSession()->setFormData($formData);
			$this->_redirect('*/*/edit', ['topic_id' => $topicId]);
		}
	}
}