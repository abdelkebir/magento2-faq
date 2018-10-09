<?php
namespace Godogi\Faq\Controller\Adminhtml\Topic;

use Godogi\Faq\Controller\Adminhtml\Topic;

class Edit extends Topic
{
	/**
	* @return void
	*/
	public function execute()
	{
		$topicId = $this->getRequest()->getParam('topic_id');
		/** @var \Godogi\Faq\Model\Topic $model */
		$model = $this->_topicFactory->create();
		if ($topicId) {
			$model->load($topicId);
			if (!$model->getId()) {
				$this->messageManager->addError(__('This topic no longer exists.'));
				$this->_redirect('*/*/');
				return;
			}
		}
		// Restore previously entered form data from session
		$data = $this->_session->getTopicData(true);
		if (!empty($data)) {
			$model->setData($data);
		}
		$this->_coreRegistry->register('godogi_faq_topic', $model);
		/** @var \Magento\Backend\Model\View\Result\Page $resultPage */
		$resultPage = $this->_resultPageFactory->create();
		$resultPage->setActiveMenu('Godogi_Faq::content_faq');
		$resultPage->getConfig()->getTitle()->prepend(__('Topic'));
		return $resultPage;
	}
}