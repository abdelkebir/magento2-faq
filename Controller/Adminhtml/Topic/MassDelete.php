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
		$collection = $this->_filter->getCollection($this->_collectionFactory->create());
		$collectionSize = $collection->getSize();
		foreach ($collection as $item) {
			try {
				// Delete URL rewrite
				$UrlRewriteCollection = $this->_urlRewrite->getCollection()
												->addFieldToFilter('request_path', 'support/'.$item->getUrl())
												->addFieldToFilter('target_path', 'support/topic/view/id/'.$item->getTopicId());
				$urlRItem = $UrlRewriteCollection->getFirstItem();
				if ($urlRItem->getId()){
        			$urlRItem->delete();  // Delete this URL rewrite.
    			}
    			$item->delete();
			} catch (\Exception $e) {
				$this->messageManager->addError($e->getMessage());
			}
		}
		$this->messageManager->addSuccess(
			__('A total of %1 topic(s) were deleted.', count($collectionSize))
		);
		$this->_redirect('*/*/index');
	}
}