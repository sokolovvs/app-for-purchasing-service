<?php

declare(strict_types=1);

namespace DoctrineMigrations;


use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210329105222 extends AbstractMigration
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
                    'CREATE TABLE plan_requests_limit_in_period (id UUID NOT NULL, plan_id UUID NOT NULL, period INT NOT NULL, _limit INT NOT NULL, PRIMARY KEY(id))'
                );
                $this->addSql('CREATE INDEX IDX_B11D5A01E899029B ON plan_requests_limit_in_period (plan_id)');
                $this->addSql('COMMENT ON COLUMN plan_requests_limit_in_period.id IS \'(DC2Type:uuid)\'');
                $this->addSql('COMMENT ON COLUMN plan_requests_limit_in_period.plan_id IS \'(DC2Type:uuid)\'');
                $this->addSql(
                    'ALTER TABLE plan_requests_limit_in_period ADD CONSTRAINT FK_B11D5A01E899029B FOREIGN KEY (plan_id) REFERENCES plan (id) NOT DEFERRABLE INITIALLY IMMEDIATE'
                );
            }
        );
    }

    public function down(Schema $schema): void
    {
        $this->connection->transactional(
            function () {
                $this->addSql('DROP TABLE plan_requests_limit_in_period');
            }
        );
    }
}
