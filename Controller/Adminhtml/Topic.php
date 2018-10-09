<?php
namespace Godogi\Faq\Controller\Adminhtml;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Godogi\Faq\Model\TopicFactory;

class Topic extends Action
{
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
	protected $_topicFactory;
	
	/**
	* @param Context $context
	* @param Registry $coreRegistry
	* @param PageFactory $resultPageFactory
	* @param TopicFactory $topicFactory
	*/
	public function __construct(
		Context $context,
		Registry $coreRegistry,
		PageFactory $resultPageFactory,
		TopicFactory $topicFactory
	) {
		parent::__construct($context);
		$this->_coreRegistry = $coreRegistry;
		$this->_resultPageFactory = $resultPageFactory;
		$this->_topicFactory = $topicFactory;
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