<?php
namespace Godogi\Faq\Model\ResourceModel\Qa;
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
	protected $_idFieldName = 'qa_id';
	/**
	 * Define resource model
	 *
	 * @return void
	 */
	protected function _construct()
	{
		$this->_init('Godogi\Faq\Model\Qa', 'Godogi\Faq\Model\ResourceModel\Qa');
	}
}