<?php
namespace Godogi\Faq\Model;
class Topic extends \Magento\Framework\Model\AbstractModel
{
	protected function _construct()
	{
		$this->_init('Godogi\Faq\Model\ResourceModel\Topic');
	}
}