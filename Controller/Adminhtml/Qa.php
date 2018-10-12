<?php
namespace Godogi\Faq\Controller\Adminhtml;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Magento\UrlRewrite\Model\UrlRewriteFactory;
use Magento\UrlRewrite\Model\UrlRewrite;
use Godogi\Faq\Model\QaFactory;

class Qa extends Action
{
	/**
	* @var UrlRewrite
	*/
	protected $_urlRewrite;
	/**
	* @var UrlRewriteFactory
	*/
	protected $_urlRewriteFactory;
	/**
	* Core registry
	*
	* @var \Magento\Framework\Registry
	*/
	protected $_coreRegistry;
	/**
	* Result page factory
	*
	* @var \Magento\Framework\View\Result\PageFactory
	*/
	protected $_resultPageFactory;
	/**
	* News model factory
	*
	* @var \Tutorial\SimpleNews\Model\NewsFactory
	*/
	protected $_qaFactory;
	
	/**
	* @param Context $context
	* @param Registry $coreRegistry
	* @param PageFactory $resultPageFactory
	* @param QaFactory $qaFactory
	* @param UrlRewriteFactory $urlRewriteFactory
	* @param UrlRewrite $urlRewrite
	*/
	public function __construct(
		Context $context,
		Registry $coreRegistry,
		PageFactory $resultPageFactory,
		QaFactory $qaFactory,
		UrlRewriteFactory $urlRewriteFactory,
		UrlRewrite $urlRewrite
	) {
		parent::__construct($context);
		$this->_coreRegistry = $coreRegistry;
		$this->_resultPageFactory = $resultPageFactory;
		$this->_qaFactory = $qaFactory;
		$this->_urlRewriteFactory = $urlRewriteFactory;
		$this->_urlRewrite = $urlRewrite;
	}
	
	
	public function execute()
	{
		return true;
	}
    
    
	/**
	* Qa access rights checking
	*
	* @return bool
	*/
	protected function _isAllowed()
	{
		return $this->_authorization->isAllowed('Godogi_Faq::content_faq_qa');
	}
}