<?php
namespace Godogi\Faq\Setup;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\DB\Ddl\Table;
class InstallSchema implements InstallSchemaInterface
{
	public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
	{
		$setup->startSetup();
		if (!$setup->tableExists('godogi_faq_qa')){
			$table = $setup->getConnection()->newTable($setup->getTable('godogi_faq_qa'))
			->addColumn(
				'qa_id',
				Table::TYPE_INTEGER,
				null,
				['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
				'Question Answer Id')
			->addColumn(
				'topic_id',
				Table::TYPE_INTEGER,
				null,
				['unsigned' => true,'nullable' => false,'primary' => true],
				'Topic ID')
			->addColumn(
				'question',
				Table::TYPE_TEXT,
				500,
				[],
				'Question')
			->addColumn(
				'answer_summary',
				Table::TYPE_TEXT,
				500,
				[],
				'Answer Summary')
			->addColumn(
				'answer',
				Table::TYPE_TEXT,
				2000,
				[],
				'Answer')
			->addColumn(
				'url',
				Table::TYPE_TEXT,
				500,
				[],
				'URL')
			->addColumn(
				'created_at',
				Table::TYPE_TIMESTAMP,
				null,
				['nullable' => false, 'default' => Table::TIMESTAMP_INIT],
				'Created At')
			->addColumn(
				'updated_at',
				Table::TYPE_TIMESTAMP,
				null,
				['nullable' => false, 'default' => Table::TIMESTAMP_INIT_UPDATE],
				'Updated At')
			->setComment('Questions and Answers');
			$setup->getConnection()->createTable($table);
		}
		if (!$setup->tableExists('godogi_faq_topic')){
			$table = $setup->getConnection()->newTable($setup->getTable('godogi_faq_topic')
			)->addColumn(
				'topic_id',
				Table::TYPE_INTEGER,
				null,
				['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
				'Topic Id')
			->addColumn(
				'title',
				Table::TYPE_TEXT,
				500,
				[],
				'Title')
			->addColumn(
				'url',
				Table::TYPE_TEXT,
				500,
				[],
				'URL')
			->addColumn(
				'created_at',
				Table::TYPE_TIMESTAMP,
				null,
				['nullable' => false, 'default' => Table::TIMESTAMP_INIT],
				'Created At')
			->addColumn(
				'updated_at',
				Table::TYPE_TIMESTAMP,
				null,
				['nullable' => false, 'default' => Table::TIMESTAMP_INIT_UPDATE],
				'Updated At'
			)->setComment(
				'Topics'
			);
			$setup->getConnection()->createTable($table);
		}
		$setup->endSetup();
	}
}