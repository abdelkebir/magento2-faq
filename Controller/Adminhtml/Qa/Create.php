<?php
namespace Godogi\Faq\Controller\Adminhtml\Qa;

use Godogi\Faq\Controller\Adminhtml\Qa;

class Create extends Qa
{
	public function execute()
	{
		$this->_forward('edit');
	}
}