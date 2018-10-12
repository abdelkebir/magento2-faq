<?php
namespace Godogi\Faq\Helper;

use \Magento\Framework\App\Helper\AbstractHelper;
use \Magento\Framework\App\Helper\Context;
use \Godogi\Faq\Model\ResourceModel\Topic\CollectionFactory as TopicCollectionFactory;
use \Godogi\Faq\Model\ResourceModel\Qa\CollectionFactory as QaCollectionFactory;

class Data extends AbstractHelper
{
	protected $_topicFactory;
	protected $_qaFactory;
	
	public function __construct(
		Context $context,
		TopicCollectionFactory $topicFactory,
		QaCollectionFactory $qaFactory)
	{
		$this->_topicFactory = $topicFactory;
		$this->_qaFactory = $qaFactory;
		parent::__construct($context);
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
	
	public function getTopics()
	{
		$topics = [];
		$collection = $this->_topicFactory->create();
		foreach($collection as $topic){
			$topics[$topic->getTopicId()]['id']=$topic->getId();
			$topics[$topic->getTopicId()]['title']=$topic->getTitle();
			$topics[$topic->getTopicId()]['url']=$topic->getUrl();
		}
		return $topics;
	}
	public function getQasByTopicId($topicId)
	{
		$qas = [];
		$collection = $this->_qaFactory->create();
		$collection->addFieldToFilter('topic_id',array('eq' => $topicId));
		foreach($collection as $qa){
			$qas[$qa->getQaId()]['question']=$qa->getQuestion();
			$qas[$qa->getQaId()]['url']=$qa->getUrl();
		}
		return $qas;
	}
}