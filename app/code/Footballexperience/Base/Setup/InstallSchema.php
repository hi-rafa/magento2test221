<?php

namespace Footballexperience\Base\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

use Footballexperience\Base\Api\Data\MatchInterface;
use Footballexperience\Base\Api\Data\StadiumInterface;
use Footballexperience\Base\Api\Data\TeamInterface;

/**
 * @codeCoverageIgnore
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        
        $installer = $setup;
        
        /**
         * Prepare database for install
         */
        $installer->startSetup();
        
        /**
         * Create table for Stadium
         */
        $tableStadium = $installer->getConnection()->newTable(
            $installer->getTable(StadiumInterface::TABLE)
        )->addColumn(
            StadiumInterface::ID,
            Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
            'Id'
        )->addColumn(
            StadiumInterface::NAME,
            Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Name'
        )->addColumn(
            StadiumInterface::CITY,
            Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'City'
        )->addColumn(
            StadiumInterface::COUNTRY,
            Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Country'
        )->addColumn(
            StadiumInterface::DESCRIPTION,
            Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Description'
        )->addColumn(
            StadiumInterface::CAPACITY,
            Table::TYPE_INTEGER,
            10,
            ['nullable' => false],
            'Capacity'
        )->addColumn(
            StadiumInterface::MAP,
            Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Map'
        )->setComment(
            'Stadium entity'
        );
        
    
//
//        /**
//         * Create table for Team
//         */
//        $tableTeam = $installer->getConnection()->newTable($installer->getTable(TeamInterface::TABLE)
//        )->addColumn(
//            TeamInterface::ID,
//            Table::TYPE_INTEGER,
//            null,
//            ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
//            'Id'
//        )->addColumn(
//            TeamInterface::NAME,
//            Table::TYPE_TEXT,
//            null,
//            ['nullable' => false],
//            'Name'
//        )->addColumn(
//            TeamInterface::CITY,
//            Table::TYPE_TEXT,
//            null,
//            ['nullable' => false],
//            'City'
//        )->addColumn(
//            TeamInterface::COUNTRY,
//            Table::TYPE_TEXT,
//            null,
//            ['nullable' => false],
//            'Country'
//        )->addColumn(
//            TeamInterface::DESCRIPTION,
//            Table::TYPE_TEXT,
//            null,
//            ['nullable' => false],
//            'Description'
//        )->addColumn(
//            TeamInterface::CAPACITY,
//            Table::TYPE_INTEGER,
//            null,
//            ['nullable' => false],
//            'Name'
//        )->setComment(
//            'Team entity'
//        );
    
    
        
      
        
        /**
         * Prepare database after install
         */
        $installer->getConnection()->createTable($tableStadium);
//        $installer->getConnection()->createTable($tableTeam);
        $installer->endSetup();
    }
}