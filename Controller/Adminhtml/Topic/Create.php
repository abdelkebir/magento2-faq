<?php
namespace Godogi\Faq\Controller\Adminhtml\Topic;

use Godogi\Faq\Controller\Adminhtml\Topic;

class Create extends Topic
{
	public function execute()
	{
		$this->_forward('edit');
	}
}