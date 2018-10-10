<?php

namespace Godogi\Faq\Block\Adminhtml\Qa\Edit;

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
		$this->setId('qa_edit_tabs');
		$this->setDestElementId('edit_form');
		$this->setTitle(__('Qa Information'));
	}
	/**
	* @return $this
	*/
	protected function _beforeToHtml()
	{
		$this->addTab(
			'qa_info',
			[
				'label' => __('General'),
				'title' => __('General'),
				'content' => $this->getLayout()->createBlock('Godogi\Faq\Block\Adminhtml\Qa\Edit\Tab\Info')->toHtml(),
				'active' => true
			]
		);
		return parent::_beforeToHtml();
	}
}