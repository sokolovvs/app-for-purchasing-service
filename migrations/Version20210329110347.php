<?php

declare(strict_types=1);

namespace DoctrineMigrations;


use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210329110347 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create table subscription';
    }

    public function up(Schema $schema): void
    {
        $this->connection->transactional(
            function () {
                $this->addSql(
                    'CREATE TABLE subscription (id UUID NOT NULL, _user_id UUID NOT NULL, plan_id UUID NOT NULL, status_id UUID NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, expired_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))'
                );
                $this->addSql('CREATE INDEX IDX_A3C664D3D32632E8 ON subscription (_user_id)');
                $this->addSql('CREATE INDEX IDX_A3C664D3E899029B ON subscription (plan_id)');
                $this->addSql('CREATE INDEX IDX_A3C664D36BF700BD ON subscription (status_id)');
                $this->addSql('COMMENT ON COLUMN subscription.id IS \'(DC2Type:uuid)\'');
                $this->addSql('COMMENT ON COLUMN subscription._user_id IS \'(DC2Type:uuid)\'');
                $this->addSql('COMMENT ON COLUMN subscription.plan_id IS \'(DC2Type:uuid)\'');
                $this->addSql('COMMENT ON COLUMN subscription.status_id IS \'(DC2Type:uuid)\'');
                $this->addSql(
                    'ALTER TABLE subscription ADD CONSTRAINT FK_A3C664D3D32632E8 FOREIGN KEY (_user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE'
                );
                $this->addSql(
                    'ALTER TABLE subscription ADD CONSTRAINT FK_A3C664D3E899029B FOREIGN KEY (plan_id) REFERENCES plan (id) NOT DEFERRABLE INITIALLY IMMEDIATE'
                );
                $this->addSql(
                    'ALTER TABLE subscription ADD CONSTRAINT FK_A3C664D36BF700BD FOREIGN KEY (status_id) REFERENCES subscription_status (id) NOT DEFERRABLE INITIALLY IMMEDIATE'
                );
            }
        );
    }

    public function down(Schema $schema): void
    {
        $this->connection->transactional(
            function () {
                $this->addSql('DROP TABLE subscription');
            }
        );
    }
}
