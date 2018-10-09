<?php
namespace Godogi\Faq\Controller\Adminhtml\Topic;

use Godogi\Faq\Controller\Adminhtml\Topic;

class Delete extends Topic
{
	/**
	* @return void
	*/
	public function execute()
	{
		$topicId = (int) $this->getRequest()->getParam('topic_id');
		if ($topicId) {
			/** @var $topicModel \Godogi\Faq\Model\Topic */
			$topicModel = $this->_topicFactory->create();
			$topicModel->load($topicId);
			// Check this topic exists or not
			if (!$topicModel->getId()) {
				$this->messageManager->addError(__('This topic no longer exists.'));
			} else {
				try {
					// Delete news
					$topicModel->delete();
					$this->messageManager->addSuccess(__('The topic has been deleted.'));
					// Redirect to grid page
					$this->_redirect('*/*/');
					return;
				} catch (\Exception $e) {
					$this->messageManager->addError($e->getMessage());
					$this->_redirect('*/*/edit', ['topic_id' => $topicModel->getTopicId()]);
				}
			}
		}
	}
}