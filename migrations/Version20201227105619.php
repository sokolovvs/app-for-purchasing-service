<?php

declare(strict_types=1);

namespace DoctrineMigrations;


use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201227105619 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->connection->transactional(
            function () {
                $this->addSql(
                    'CREATE TABLE email_confirm (id UUID NOT NULL, _user_id UUID NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, hash VARCHAR(255) NOT NULL, PRIMARY KEY(id))'
                );
                $this->addSql('CREATE INDEX IDX_3213CB8BD32632E8 ON email_confirm (_user_id)');
                $this->addSql('COMMENT ON COLUMN email_confirm.id IS \'(DC2Type:uuid)\'');
                $this->addSql('COMMENT ON COLUMN email_confirm._user_id IS \'(DC2Type:uuid)\'');
                $this->addSql(
                    'CREATE TABLE "user" (id UUID NOT NULL, email VARCHAR(255) NOT NULL, password_hash VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, timezone VARCHAR(255) NOT NULL, is_active BOOLEAN NOT NULL, dtype VARCHAR(255) NOT NULL, PRIMARY KEY(id))'
                );
                $this->addSql('COMMENT ON COLUMN "user".id IS \'(DC2Type:uuid)\'');
                $this->addSql(
                    'ALTER TABLE email_confirm ADD CONSTRAINT FK_3213CB8BD32632E8 FOREIGN KEY (_user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE'
                );
            }
        );
    }

    public function down(Schema $schema): void
    {
        $this->connection->transactional(
            function () {
                $this->addSql('ALTER TABLE email_confirm DROP CONSTRAINT FK_3213CB8BD32632E8');
                $this->addSql('DROP TABLE email_confirm');
                $this->addSql('DROP TABLE "user"');
            }
        );
    }
}
