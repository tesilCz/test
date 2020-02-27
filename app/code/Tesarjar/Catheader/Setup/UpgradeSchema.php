<?php


namespace Tesarjar\Catheader\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * Class UpgradeSchema
 *
 * @package Tesarjar\Catheader\Setup
 */
class UpgradeSchema implements UpgradeSchemaInterface
{

    /**
     * {@inheritdoc}
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context) {
        if (version_compare($context->getVersion(), "1.0.1") < 0) {

            $tableName = $setup->getTable('tesarjar_catheader_catheader');
            if ($setup->getConnection()->isTableExists($tableName) == true) {
                $conn = $setup->getConnection();

                $conn->addColumn($tableName, 'manufacturer',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'comment' =>'Catheader Manufacturer',
                    'length' => '255',
                    'nullable' => true
                ]);
                $conn->addColumn($tableName, 'active',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    'comment' =>'Catheader Is Active',
                    'length' => '1',
                    'default'  => 1,
                    'nullable' => true
                ]);

            }

        }
    }
}

