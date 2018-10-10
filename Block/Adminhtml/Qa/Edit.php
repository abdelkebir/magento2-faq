<?php
namespace Godogi\Faq\Block\Adminhtml\Qa;

use Magento\Backend\Block\Widget\Form\Container;
use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Registry;

class Edit extends Container
{
	/**
	* Core registry
	*
	* @var \Magento\Framework\Registry
	*/
	protected $_coreRegistry = null;
	/**
	* @param Context $context
	* @param Registry $registry
	* @param array $data
	*/
	public function __construct(
		Context $context,
		Registry $registry,
		array $data = []
	) {
		$this->_coreRegistry = $registry;
		parent::__construct($context, $data);
	}
	/**
	* Class constructor
	*
	* @return void
	*/
	protected function _construct()
	{
		$this->_objectId = 'id';
		$this->_controller = 'adminhtml_qa';
		$this->_blockGroup = 'Godogi_Faq';
		parent::_construct();
		$this->buttonList->update('save', 'label', __('Save'));
		$this->buttonList->add(
			'saveandcontinue',
			[
				'label' => __('Save and Continue Edit'),
				'class' => 'save',
				'data_attribute' => [
					'mage-init' => [
						'button' => [
							'event' => 'saveAndContinueEdit',
							'target' => '#edit_form'
						]
					]
				]
			],
		-100
		);
		$this->buttonList->update('delete', 'label', __('Delete'));
	}
	/**
	* Retrieve text for header element depending on loaded news
	*
	* @return string
	*/
	public function getHeaderText()
	{
		$qaRegistry = $this->_coreRegistry->registry('godogi_faq_qa');
		if ($qaRegistry->getId()) {
			$qaTitle = $this->escapeHtml($qaRegistry->getTitle());
			return __("Edit Qa '%1'", $qaTitle);
		} else {
			return __('Add Qa');
		}
	}
}