<?php
namespace Godogi\Faq\Helper;

use \Magento\Framework\App\Helper\AbstractHelper;
use \Magento\Framework\App\Helper\Context;
use \Godogi\Faq\Model\ResourceModel\Topic\CollectionFactory as TopicCollectionFactory;
use \Godogi\Faq\Model\ResourceModel\Qa\CollectionFactory as QaCollectionFactory;
use \Godogi\Faq\Model\QaFactory;
use \Godogi\Faq\Model\TopicFactory;

class Data extends AbstractHelper
{
	protected $_templateProcessor;
	protected $_topicCollectionFactory;
	protected $_qaCollectionFactory;
	/**
 	* @var QaFactory
 	*/
	protected $_qaFactory;
	/**
 	* @var TopicFactory
 	*/
	protected $_topicFactory;
	
	public function __construct(
		Context $context,
		TopicCollectionFactory $topicCollectionFactory,
		QaCollectionFactory $qaCollectionFactory,
		QaFactory $qaFactory,
		TopicFactory $topicFactory,
		\Zend_Filter_Interface $templateProcessor)
	{
		$this->_topicCollectionFactory = $topicCollectionFactory;
		$this->_qaCollectionFactory = $qaCollectionFactory;
		$this->_qaFactory = $qaFactory;
		$this->_topicFactory = $topicFactory;
		$this->_templateProcessor = $templateProcessor;
		parent::__construct($context);
	}
	
	public function toOptionArray()
	{
		$options = [];
		$collection = $this->_topicCollectionFactory->create();
		foreach($collection as $topic){
			$options[$topic->getTopicId()]=$topic->getTitle();
		}
		return $options;
	}
	
	public function getTopics()
	{
		$topics = [];
		$collection = $this->_topicCollectionFactory->create();
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
		$collection = $this->_qaCollectionFactory->create();
		$collection->addFieldToFilter('topic_id',array('eq' => $topicId));
		foreach($collection as $qa){
			$qas[$qa->getQaId()]['question']=$qa->getQuestion();
			$qas[$qa->getQaId()]['answer_summary']=$qa->getAnswerSummary();
			$qas[$qa->getQaId()]['url']=$qa->getUrl();
		}
		return $qas;
	}
	public function getQasByTopicIdLimited($topicId)
	{
		$qas = [];
		$collection = $this->_qaCollectionFactory->create();
		$collection->addFieldToFilter('topic_id',array('eq' => $topicId));
		$collection->setPageSize(5)->setCurPage(1);
		foreach($collection as $qa){
			$qas[$qa->getQaId()]['question']=$qa->getQuestion();
			$qas[$qa->getQaId()]['answer_summary']=$qa->getAnswerSummary();
			$qas[$qa->getQaId()]['url']=$qa->getUrl();
		}
		return $qas;
	}
	public function getCurrentTopic($topicId){
		$topic = $this->_topicFactory->create();
		$topic = $topic->load($topicId);
		return $topic->getData();
	}
	public function getTopicById($topicId){
		$topic = $this->_topicFactory->create();
		$topic = $topic->load($topicId);
		return $topic->getData();
	}
	public function getCurrentQa($qaId){
		$qa = $this->_qaFactory->create();
		$qa = $qa->load($qaId);
		return $qa->getData();
	}
	public function getSearchResults($q) {
		$qas = [];
		$collection = $this->_qaCollectionFactory->create();
		$collection->addFieldToFilter(
		    array('question', 'answer'),
		    array(
		        array('like' => '%'.$q.'%'),
		        array('like' => '%'.$q.'%')
		    )
		);
		foreach($collection as $qa){
			$qas[$qa->getQaId()]['question']=$qa->getQuestion();
			$qas[$qa->getQaId()]['answer_summary']=$qa->getAnswerSummary();
			$qas[$qa->getQaId()]['url']=$qa->getUrl();
		}
		return $qas;
	}
}