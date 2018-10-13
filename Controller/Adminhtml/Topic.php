<?php
namespace Godogi\Faq\Controller\Adminhtml;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Magento\UrlRewrite\Model\UrlRewriteFactory;
use Magento\UrlRewrite\Model\UrlRewrite;
use Magento\Ui\Component\MassAction\Filter;

use Godogi\Faq\Model\TopicFactory;
use Godogi\Faq\Model\ResourceModel\Topic\CollectionFactory;

class Topic extends Action
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
	* @var Registry
	*/
	protected $_coreRegistry;
	/**
	* Result page factory
	*
	* @var PageFactory
	*/
	protected $_resultPageFactory;
	/**
	* Topic model factory
	*
	* @var TopicFactory
	*/
	protected $_topicFactory;
	/**
	* @var CollectionFactory
	*/
	protected $_collectionFactory;
	
	/**
	* @param Context $context
	* @param Registry $coreRegistry
	* @param PageFactory $resultPageFactory
	* @param TopicFactory $topicFactory
	* @param CollectionFactory $collectionFactory
	* @param UrlRewriteFactory $urlRewriteFactory
	* @param UrlRewrite $urlRewrite
	* @param Filter $filter
	*/
	public function __construct(
		Context $context,
		Registry $coreRegistry,
		PageFactory $resultPageFactory,
		TopicFactory $topicFactory,
		CollectionFactory $collectionFactory,
		UrlRewriteFactory $urlRewriteFactory,
		UrlRewrite $urlRewrite,
		Filter $filter
	) {
		parent::__construct($context);
		$this->_coreRegistry = $coreRegistry;
		$this->_resultPageFactory = $resultPageFactory;
		$this->_topicFactory = $topicFactory;
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
	* Topic access rights checking
	*
	* @return bool
	*/
	protected function _isAllowed()
	{
		return $this->_authorization->isAllowed('Godogi_Faq::content_faq_topic');
	}
}