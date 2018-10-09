<?php
namespace Godogi\Faq\Model;
class Qa extends \Magento\Framework\Model\AbstractModel
{
	protected function _construct()
	{
		$this->_init('Godogi\Faq\Model\ResourceModel\Qa');
	}
}