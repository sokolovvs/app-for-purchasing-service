<?php

declare(strict_types=1);

namespace DoctrineMigrations;


use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210329112227 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'CREATE TABLE api_request';
    }

    public function up(Schema $schema): void
    {
        $this->connection->transactional(
            function () {
                $this->addSql(
                    'CREATE TABLE api_request (id UUID NOT NULL, subscription_id UUID NOT NULL, content JSON NOT NULL, called_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))'
                );
                $this->addSql('CREATE INDEX IDX_D6A9FBF89A1887DC ON api_request (subscription_id)');
                $this->addSql('COMMENT ON COLUMN api_request.id IS \'(DC2Type:uuid)\'');
                $this->addSql('COMMENT ON COLUMN api_request.subscription_id IS \'(DC2Type:uuid)\'');
                $this->addSql(
                    'ALTER TABLE api_request ADD CONSTRAINT FK_D6A9FBF89A1887DC FOREIGN KEY (subscription_id) REFERENCES subscription (id) NOT DEFERRABLE INITIALLY IMMEDIATE'
                );
            }
        );
    }

    public function down(Schema $schema): void
    {
        $this->connection->transactional(
            function () {
                $this->addSql('DROP TABLE api_request');
            }
        );
    }
}
