<?php

declare(strict_types=1);

namespace DoctrineMigrations;


use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210329104228 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create table plan';
    }

    public function up(Schema $schema): void
    {
        $this->connection->transactional(
            function () {
                $this->addSql(
                    'CREATE TABLE plan (id UUID NOT NULL, is_active BOOLEAN NOT NULL, amount INT NOT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(2048) DEFAULT NULL, PRIMARY KEY(id))'
                );
                $this->addSql('COMMENT ON COLUMN plan.id IS \'(DC2Type:uuid)\'');
            }
        );
    }

    public function down(Schema $schema): void
    {
        $this->connection->transactional(
            function () {
                $this->addSql('DROP TABLE plan');
            }
        );
    }
}
