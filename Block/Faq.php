<?php
namespace Godogi\Faq\Block;

use Magento\Framework\View\Element\Template\Context;
use Godogi\Faq\Helper\Data as FaqData;

class Faq extends \Magento\Framework\View\Element\Template
{
	protected $_faqHelper;
	
	public function __construct(
				Context $context,
				FaqData $faqHelper,
				array $data = [])
	{
		$this->_faqHelper = $faqHelper;
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
}
