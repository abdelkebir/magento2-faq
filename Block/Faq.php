<?php
namespace Godogi\Faq\Block;

use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\App\RequestInterface;
use Godogi\Faq\Helper\Data as FaqHelper;

class Faq extends \Magento\Framework\View\Element\Template
{
	protected $_faqHelper;
	/**
	* Request instance
	*
	* @var RequestInterface
	*/
	protected $request;
	
	public function __construct(
				Context $context,
				FaqHelper $faqHelper,
				RequestInterface $request,
				array $data = [])
	{
		$this->_faqHelper = $faqHelper;
		$this->request = $request;
		parent::__construct($context, $data);
	}
    
	public function getTopics()
	{
		return $this->_faqHelper->getTopics();
	}
	public function getQasByTopicId($topicId)
	{
		return $this->_faqHelper->getQasByTopicId($topicId);
	}
	public function getQasById()
	{
		$topicId = $this->request->getParam('id');
		return $this->getQasByTopicId($topicId);
	}
	public function getCurrentTopic()
	{
		$topicId = $this->request->getParam('id');
		return $this->_faqHelper->getCurrentTopic($topicId);
	}
	public function getCurrentQa()
	{
		$qaId = $this->request->getParam('id');
		return $this->_faqHelper->getCurrentQa($qaId);
	}
}
