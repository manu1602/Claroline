<?php

namespace Claroline\CoreBundle\Migrations\drizzle_pdo_mysql;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2013/08/30 11:28:21
 */
class Version20130830112820 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            CREATE TABLE claro_resource_mask_decoder (
                id INT AUTO_INCREMENT NOT NULL, 
                resource_type_id INT NOT NULL, 
                `value` INT NOT NULL, 
                name VARCHAR(255) NOT NULL, 
                PRIMARY KEY(id), 
                INDEX IDX_39D93F4298EC6B7B (resource_type_id)
            )
        ");
        $this->addSql("
            CREATE TABLE claro_resource_action (
                id INT AUTO_INCREMENT NOT NULL, 
                resource_type_id INT DEFAULT NULL, 
                name VARCHAR(255) DEFAULT NULL, 
                async BOOLEAN DEFAULT NULL, 
                permRequired VARCHAR(255) DEFAULT NULL, 
                PRIMARY KEY(id), 
                INDEX IDX_7EE4A91298EC6B7B (resource_type_id)
            )
        ");
        $this->addSql("
            ALTER TABLE claro_resource_mask_decoder 
            ADD CONSTRAINT FK_39D93F4298EC6B7B FOREIGN KEY (resource_type_id) 
            REFERENCES claro_resource_type (id) 
            ON DELETE CASCADE
        ");
        $this->addSql("
            ALTER TABLE claro_resource_action 
            ADD CONSTRAINT FK_7EE4A91298EC6B7B FOREIGN KEY (resource_type_id) 
            REFERENCES claro_resource_type (id) 
            ON DELETE SET NULL
        ");
        $this->addSql("
            ALTER TABLE claro_resource_rights 
            ADD mask INT NOT NULL, 
            DROP can_delete, 
            DROP can_open, 
            DROP can_edit, 
            DROP can_copy, 
            DROP can_export
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            DROP TABLE claro_resource_mask_decoder
        ");
        $this->addSql("
            DROP TABLE claro_resource_action
        ");
        $this->addSql("
            ALTER TABLE claro_resource_rights 
            ADD can_delete BOOLEAN NOT NULL, 
            ADD can_open BOOLEAN NOT NULL, 
            ADD can_edit BOOLEAN NOT NULL, 
            ADD can_copy BOOLEAN NOT NULL, 
            ADD can_export BOOLEAN NOT NULL, 
            DROP mask
        ");
    }
}