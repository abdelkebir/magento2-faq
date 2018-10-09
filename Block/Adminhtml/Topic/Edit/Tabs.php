<?php

namespace Godogi\Faq\Block\Adminhtml\Topic\Edit;

use Magento\Backend\Block\Widget\Tabs as WidgetTabs;

class Tabs extends WidgetTabs
{
	/**
	* Class constructor
	*
	* @return void
	*/
	protected function _construct()
	{
		parent::_construct();
		$this->setId('topic_edit_tabs');
		$this->setDestElementId('edit_form');
		$this->setTitle(__('Topic Information'));
	}
	/**
	* @return $this
	*/
	protected function _beforeToHtml()
	{
		$this->addTab(
			'topic_info',
			[
				'label' => __('General'),
				'title' => __('General'),
				'content' => $this->getLayout()->createBlock('Godogi\Faq\Block\Adminhtml\Topic\Edit\Tab\Info')->toHtml(),
				'active' => true
			]
		);
		return parent::_beforeToHtml();
	}
}