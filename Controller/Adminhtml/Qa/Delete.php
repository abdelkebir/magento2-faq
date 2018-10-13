<?php
namespace Godogi\Faq\Controller\Adminhtml\Qa;

use Godogi\Faq\Controller\Adminhtml\Qa;

class Delete extends Qa
{
	/**
	* @return void
	*/
	public function execute()
	{
		$qaId = (int) $this->getRequest()->getParam('qa_id');
		if ($qaId) {
			/** @var $qaModel \Godogi\Faq\Model\Qa */
			$qaModel = $this->_qaFactory->create();
			$qaModel->load($qaId);
			// Check this qa exists or not
			if (!$qaModel->getId()) {
				$this->messageManager->addError(__('This qa no longer exists.'));
			} else {
				try {
					// Delete URL rewrite
					$UrlRewriteCollection = $this->_urlRewrite->getCollection()
													->addFieldToFilter('request_path', 'support/'.$qaModel->getUrl())
													->addFieldToFilter('target_path', 'support/qa/view/id/'.$qaModel->getQaId());
					$urlRItem = $UrlRewriteCollection->getFirstItem();
					if ($urlRItem->getId()) {
        				$urlRItem->delete();  // Delete this URL rewrite.
    				}
					// Delete QA
					$qaModel->delete();
					$this->messageManager->addSuccess(__('The qa has been deleted.'));
					// Redirect to grid page
					$this->_redirect('*/*/');
					return;
				} catch (\Exception $e) {
					$this->messageManager->addError($e->getMessage());
					$this->_redirect('*/*/edit', ['qa_id' => $qaModel->getQaId()]);
				}
			}
		}
	}
}