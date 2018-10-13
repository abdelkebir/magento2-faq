<?php
namespace Godogi\Faq\Controller\Adminhtml;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Magento\UrlRewrite\Model\UrlRewriteFactory;
use Magento\UrlRewrite\Model\UrlRewrite;
use Magento\Ui\Component\MassAction\Filter;

use Godogi\Faq\Model\QaFactory;
use Godogi\Faq\Model\ResourceModel\Qa\CollectionFactory;

class Qa extends Action
{
	/**
	* @var Filter
	*/
	protected $_filter;
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
	* @var CollectionFactory
	*/
	protected $_collectionFactory;
	
	/**
	* @param Context $context
	* @param Registry $coreRegistry
	* @param PageFactory $resultPageFactory
	* @param QaFactory $qaFactory
	* @param CollectionFactory $collectionFactory
	* @param UrlRewriteFactory $urlRewriteFactory
	* @param UrlRewrite $urlRewrite
	* @param Filter $filter
	*/
	public function __construct(
		Context $context,
		Registry $coreRegistry,
		PageFactory $resultPageFactory,
		QaFactory $qaFactory,
		CollectionFactory $collectionFactory,
		UrlRewriteFactory $urlRewriteFactory,
		UrlRewrite $urlRewrite,
		Filter $filter
	) {
		parent::__construct($context);
		$this->_coreRegistry = $coreRegistry;
		$this->_resultPageFactory = $resultPageFactory;
		$this->_qaFactory = $qaFactory;
		$this->_collectionFactory = $collectionFactory;
		$this->_urlRewriteFactory = $urlRewriteFactory;
		$this->_urlRewrite = $urlRewrite;
		$this->_filter = $filter;
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