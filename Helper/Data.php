<?php
namespace Godogi\Faq\Helper;

use \Magento\Framework\App\Helper\AbstractHelper;
use \Magento\Framework\App\Helper\Context;
use \Godogi\Faq\Model\ResourceModel\Topic\CollectionFactory as TopicCollectionFactory;

class Data extends AbstractHelper
{
	protected $_topicFactory;
	
	public function __construct(
		Context $context,
		TopicCollectionFactory $topicFactory)
	{
		$this->_topicFactory = $topicFactory;
		parent::__construct($context);
	}
	
	public function RandomFunc()
	{
		
	}
	public function toOptionArray()
	{
		$options = [];
		$collection = $this->_topicFactory->create();
		foreach($collection as $topic){
			$options[$topic->getTopicId()]=$topic->getTitle();
		}
		return $options;
	}
}