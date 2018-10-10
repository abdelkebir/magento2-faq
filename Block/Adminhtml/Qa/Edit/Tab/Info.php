<?php
namespace Godogi\Faq\Block\Adminhtml\Qa\Edit\Tab;

use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Widget\Tab\TabInterface;
use Magento\Backend\Block\Template\Context;
use Magento\Framework\Registry;
use Magento\Framework\Data\FormFactory;
use Magento\Cms\Model\Wysiwyg\Config;
use Godogi\Faq\Helper\Data as FaqData;

class Info extends Generic implements TabInterface
{
	protected $_faqHelper;
	/**
	* @var \Magento\Cms\Model\Wysiwyg\Config
	*/
	protected $_wysiwygConfig;
	
	/**
	* @param Context $context
	* @param Registry $registry
	* @param FormFactory $formFactory
	* @param Config $wysiwygConfig
	* @param array $data
	*/
	public function __construct(
		Context $context,
		Registry $registry,
		FormFactory $formFactory,
		Config $wysiwygConfig,
		FaqData $faqHelper,
		array $data = []
	) {
		$this->_faqHelper = $faqHelper;
		$this->_wysiwygConfig = $wysiwygConfig;
		parent::__construct($context, $registry, $formFactory, $data);
	}
	/**
	* Prepare form fields
	*
	* @return \Magento\Backend\Block\Widget\Form
	*/
	protected function _prepareForm()
	{
		/** @var $model \Godogi\Faq\Model\Qa */
		$model = $this->_coreRegistry->registry('godogi_faq_qa');
		/** @var \Magento\Framework\Data\Form $form */
		$form = $this->_formFactory->create();
		$form->setHtmlIdPrefix('qa_');
		$form->setFieldNameSuffix('qa');
		$fieldset = $form->addFieldset(
			'base_fieldset',
			['legend' => __('General')]
		);
		if ($model->getId()) {
			$fieldset->addField(
				'qa_id',
				'hidden',
				['name' => 'qa_id']
			);
		}
		$fieldset->addField(
			'topic_id',
			'select',
			[
				'name' => 'topic_id',
				'label' => __('Topic'),
				'required' => true,
				'options' => $this->_faqHelper->toOptionArray()
			]
		);
		$fieldset->addField(
			'question',
			'text',
			[
				'name' => 'question',
				'label' => __('Question'),
				'required' => true
			]
		);
		$fieldset->addField(
			'answer_summary',
			'textarea',
			[
				'name' => 'answer_summary',
				'label' => __('Answer Summary'),
				'required' => true
			]
		);
		$wysiwygConfig = $this->_wysiwygConfig->getConfig();
		$fieldset->addField(
			'answer',
			'editor',
			[
				'name' => 'answer',
				'label' => __('Answer'),
				'required' => true,
				'config' => $wysiwygConfig
			]
		);
		$fieldset->addField(
			'url',
			'text',
			[
				'name' => 'url',
				'label' => __('URL'),
				'required' => true
			]
		);
		$data = $model->getData();
		$form->setValues($data);
		$this->setForm($form);
		return parent::_prepareForm();
	}
	/**
	* Prepare label for tab
	*
	* @return string
	*/
	public function getTabLabel()
	{
		return __('Qa Info');
	}
	/**
	* Prepare title for tab
	*
	* @return string
	*/
	public function getTabTitle()
	{
		return __('Qa Info');
	}
	/**
	* {@inheritdoc}
	*/
	public function canShowTab()
	{
		return true;
	}
	/**
	* {@inheritdoc}
	*/
	public function isHidden()
	{
		return false;
	}
}