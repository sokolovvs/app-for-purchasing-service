<?php

declare(strict_types=1);

namespace DoctrineMigrations;


use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210329111516 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'CREATE TABLE subscription_history';
    }

    public function up(Schema $schema): void
    {
        $this->connection->transactional(
            function () {
                $this->addSql(
                    'CREATE TABLE subscription_history (id UUID NOT NULL, subscription_id UUID NOT NULL, status_id UUID NOT NULL, PRIMARY KEY(id))'
                );
                $this->addSql('CREATE INDEX IDX_54AF90D09A1887DC ON subscription_history (subscription_id)');
                $this->addSql('CREATE INDEX IDX_54AF90D06BF700BD ON subscription_history (status_id)');
                $this->addSql('COMMENT ON COLUMN subscription_history.id IS \'(DC2Type:uuid)\'');
                $this->addSql('COMMENT ON COLUMN subscription_history.subscription_id IS \'(DC2Type:uuid)\'');
                $this->addSql('COMMENT ON COLUMN subscription_history.status_id IS \'(DC2Type:uuid)\'');
                $this->addSql(
                    'ALTER TABLE subscription_history ADD CONSTRAINT FK_54AF90D09A1887DC FOREIGN KEY (subscription_id) REFERENCES subscription (id) NOT DEFERRABLE INITIALLY IMMEDIATE'
                );
                $this->addSql(
                    'ALTER TABLE subscription_history ADD CONSTRAINT FK_54AF90D06BF700BD FOREIGN KEY (status_id) REFERENCES subscription_status (id) NOT DEFERRABLE INITIALLY IMMEDIATE'
                );
            }
        );
    }

    public function down(Schema $schema): void
    {
        $this->connection->transactional(
            function () {
                $this->addSql('DROP TABLE subscription_history');
            }
        );
    }
}
