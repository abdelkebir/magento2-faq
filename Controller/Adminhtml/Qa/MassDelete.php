<?php
namespace Godogi\Faq\Controller\Adminhtml\Qa;

use Godogi\Faq\Controller\Adminhtml\Qa;

class MassDelete extends Qa
{
	/**
	* @return void
	*/
	public function execute()
	{
		// Get IDs of the selected qas
		$qaIds = $this->getRequest()->getParam('qa');
		print_r($this->getRequest()->getPost());
		exit();
		foreach ($qaIds as $qaId) {
			try {
				/** @var $qaModel \Godogi\Faq\Model\Qa */
				$qaModel = $this->_qaFactory->create();
				$qaModel->load($qaId)->delete();
				// Delete URL rewrite
				$UrlRewriteCollection = $this->_urlRewrite->getCollection()
												->addFieldToFilter('request_path', 'faqtest/'.$qaModel->getUrl())
												->addFieldToFilter('target_path', 'faqtest/qa/view/id/'.$qaModel->getQaId());
				$urlRItem = $UrlRewriteCollection->getFirstItem();
				if ($urlRItem->getId()) {
        			$urlRItem->delete();  // Delete this URL rewrite.
    			}
			} catch (\Exception $e) {
				$this->messageManager->addError($e->getMessage());
			}
		}
		if (count($qaIds)) {
			$this->messageManager->addSuccess(
				__('A total of %1 qa(s) were deleted.', count($qaIds))
			);
		}
		$this->_redirect('*/*/index');
	}
}