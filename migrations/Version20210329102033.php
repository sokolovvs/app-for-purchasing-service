<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210329102033 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $this->connection->transactional(function () {
            $this->addSql('CREATE TABLE refresh_token (id UUID NOT NULL, _user_id UUID NOT NULL, token VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
            $this->addSql('CREATE INDEX IDX_C74F2195D32632E8 ON refresh_token (_user_id)');
            $this->addSql('COMMENT ON COLUMN refresh_token.id IS \'(DC2Type:uuid)\'');
            $this->addSql('COMMENT ON COLUMN refresh_token._user_id IS \'(DC2Type:uuid)\'');
            $this->addSql('ALTER TABLE refresh_token ADD CONSTRAINT FK_C74F2195D32632E8 FOREIGN KEY (_user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        });
    }

    public function down(Schema $schema) : void
    {
        $this->connection->transactional(function () {
            $this->addSql('DROP TABLE refresh_token');
        });
    }
}
