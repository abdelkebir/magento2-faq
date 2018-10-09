<?php
namespace Godogi\Faq\Model\ResourceModel\Topic;
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
	/**
	 * Define resource model
	 *
	 * @return void
	 */
	protected function _construct()
	{
		$this->_init('Godogi\Faq\Model\Topic', 'Godogi\Faq\Model\ResourceModel\Topic');
	}
}