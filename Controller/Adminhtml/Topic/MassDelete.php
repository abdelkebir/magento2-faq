<?php
namespace Godogi\Faq\Controller\Adminhtml\Topic;

use Godogi\Faq\Controller\Adminhtml\Topic;

class MassDelete extends Topic
{
	/**
	* @return void
	*/
	public function execute()
	{
		// Get IDs of the selected topics
		$topicIds = $this->getRequest()->getParam('topic');
		foreach ($topicIds as $topicId) {
			try {
				/** @var $topicModel \Godogi\Faq\Model\Topic */
				$topicModel = $this->_topicFactory->create();
				$topicModel->load($topicId)->delete();
				// Delete URL rewrite
				$UrlRewriteCollection = $this->_urlRewrite->getCollection()
												->addFieldToFilter('request_path', 'faqtest/'.$topicModel->getUrl())
												->addFieldToFilter('target_path', 'faqtest/topic/view/id/'.$topicModel->getTopicId());
				$urlRItem = $UrlRewriteCollection->getFirstItem();
				if ($urlRItem->getId()){
        			$urlRItem->delete();  // Delete this URL rewrite.
    			}
    				
			} catch (\Exception $e) {
				$this->messageManager->addError($e->getMessage());
			}
		}
		if (count($topicIds)) {
			$this->messageManager->addSuccess(
				__('A total of %1 topic(s) were deleted.', count($topicIds))
			);
		}
		$this->_redirect('*/*/index');
	}
}