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
			
			
			
			if($qaModel->getQaId()){ // On qa edit (qa already exist)
				// Url rewrite collection with same request path
				$UrlRewriteCollection = $this->_urlRewrite->getCollection()->addFieldToFilter('request_path', 'support/'.$formData["url"]);
				$urlRItem = $UrlRewriteCollection->getFirstItem();
				foreach($UrlRewriteCollection as $urlRewrite){
					if($urlRewrite['target_path'] != 'support/qa/view/id/'.$qaModel->getQaId()){
						$this->messageManager->addError(__('This URL already exist.'));
        				$this->_redirect('*/*/create');
						return;
					}
				}
				if ($urlRItem->getId()) {
        			$urlRItem->delete();  // Delete this URL rewrite, we will create a new one on qa creation.
    			}
			}else{ // On new qa creation
				$UrlRewriteCollection = $this->_urlRewrite->getCollection()->addFieldToFilter('request_path', 'support/'.$formData["url"]);
    			$urlRItem = $UrlRewriteCollection->getFirstItem(); 
    			if ($urlRItem->getId()) { // Request path already exist
        			$this->messageManager->addError(__('This URL already exist.'));
        			$this->_redirect('*/*/create');
					return;
    			}
			}
			
			
			try {
				// Save news
				$qaModel->save();
				
				$urlRewriteModel = $this->_urlRewriteFactory->create();
				/* set current store id */
				$urlRewriteModel->setStoreId(1);
				/* this url is not created by system so set as 0 */
				$urlRewriteModel->setIsSystem(0);
				/* unique identifier - set random unique value to id path */
				$urlRewriteModel->setIdPath(rand(1, 100000));
				/* set actual url path to target path field */
				$urlRewriteModel->setTargetPath("support/qa/view/id/".$qaModel->getQaId());
				/* set requested path which you want to create */
				$urlRewriteModel->setRequestPath("support/".$formData["url"]);
				$urlRewriteModel->save();
				
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