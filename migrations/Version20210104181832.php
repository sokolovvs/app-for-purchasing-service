<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210104181832 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $this->connection->transactional(function () {
            $this->addSql('CREATE TABLE card (id UUID NOT NULL, _user_id UUID NOT NULL, card_token VARCHAR(255) DEFAULT NULL, last6 VARCHAR(255) DEFAULT NULL, first4 VARCHAR(255) DEFAULT NULL, active BOOLEAN NOT NULL, type VARCHAR(255) DEFAULT NULL, holder_name VARCHAR(255) DEFAULT NULL, expired_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
            $this->addSql('CREATE INDEX IDX_161498D3D32632E8 ON card (_user_id)');
            $this->addSql('COMMENT ON COLUMN card.id IS \'(DC2Type:uuid)\'');
            $this->addSql('COMMENT ON COLUMN card._user_id IS \'(DC2Type:uuid)\'');
            $this->addSql('ALTER TABLE card ADD CONSTRAINT FK_161498D3D32632E8 FOREIGN KEY (_user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        });
    }

    public function down(Schema $schema) : void
    {
        $this->connection->transactional(function () {
            $this->addSql('DROP TABLE card');
        });
    }
}
