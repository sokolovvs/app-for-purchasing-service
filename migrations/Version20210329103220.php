<?php

declare(strict_types=1);

namespace DoctrineMigrations;


use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210329103220 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create table subscription_status';
    }

    public function up(Schema $schema): void
    {
        $this->connection->transactional(
            function () {
                $this->addSql(
                    'CREATE TABLE subscription_status (id UUID NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id))'
                );
                $this->addSql('COMMENT ON COLUMN subscription_status.id IS \'(DC2Type:uuid)\'');
            }
        );
    }

    public function down(Schema $schema): void
    {
        $this->connection->transactional(
            function () {
                $this->addSql('DROP TABLE subscription_status');
            }
        );
    }
}
