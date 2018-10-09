<?php
namespace Godogi\Faq\Model\ResourceModel;
class Topic extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
	public function __construct(
		\Magento\Framework\Model\ResourceModel\Db\Context $context
	){
		parent::__construct($context);
	}
	protected function _construct()
	{
		$this->_init('godogi_faq_topic', 'topic_id');
	}
}