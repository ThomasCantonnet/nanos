<?php declare(strict_types=1);

namespace DoctrineORMModule\Nanos;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180809165115 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE nanos_platform_status_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE nanos_campaign_status_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE nanos_campaign_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE nanos_platform_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE nanos_target_audience_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE nanos_platform_status (id INT NOT NULL, code VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE nanos_campaign_status (id INT NOT NULL, code VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE nanos_campaign (id INT NOT NULL, status_id INT NOT NULL, name VARCHAR(255) NOT NULL, goal VARCHAR(255) NOT NULL, totalBudget INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_8D7500D56BF700BD ON nanos_campaign (status_id)');
        $this->addSql('CREATE TABLE nanos_campaign_platform (campaign_id INT NOT NULL, platform_id INT NOT NULL, PRIMARY KEY(campaign_id, platform_id))');
        $this->addSql('CREATE INDEX IDX_557C6957F639F774 ON nanos_campaign_platform (campaign_id)');
        $this->addSql('CREATE INDEX IDX_557C6957FFE6496F ON nanos_campaign_platform (platform_id)');
        $this->addSql('CREATE TABLE nanos_platform (id INT NOT NULL, status_id INT NOT NULL, totalBudget INT NOT NULL, remainingBudget INT NOT NULL, startDate TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, endDate TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creatives JSON NOT NULL, insights JSON NOT NULL, targetAudience_id INT DEFAULT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_AB32C2C36BF700BD ON nanos_platform (status_id)');
        $this->addSql('CREATE INDEX IDX_AB32C2C353B76128 ON nanos_platform (targetAudience_id)');
        $this->addSql('CREATE TABLE nanos_platform_facebook (id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE nanos_platform_adwords (id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE nanos_platform_instagram (id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE nanos_target_audience (id INT NOT NULL, languages JSON NOT NULL, genders JSON NOT NULL, ageRange JSON NOT NULL, locations JSON NOT NULL, interests JSON NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE nanos_campaign ADD CONSTRAINT FK_8D7500D56BF700BD FOREIGN KEY (status_id) REFERENCES nanos_campaign_status (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE nanos_campaign_platform ADD CONSTRAINT FK_557C6957F639F774 FOREIGN KEY (campaign_id) REFERENCES nanos_campaign (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE nanos_campaign_platform ADD CONSTRAINT FK_557C6957FFE6496F FOREIGN KEY (platform_id) REFERENCES nanos_platform (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE nanos_platform ADD CONSTRAINT FK_AB32C2C36BF700BD FOREIGN KEY (status_id) REFERENCES nanos_platform_status (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE nanos_platform ADD CONSTRAINT FK_AB32C2C353B76128 FOREIGN KEY (targetAudience_id) REFERENCES nanos_target_audience (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE nanos_platform_facebook ADD CONSTRAINT FK_B05AA711BF396750 FOREIGN KEY (id) REFERENCES nanos_platform (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE nanos_platform_adwords ADD CONSTRAINT FK_1311BD8BF396750 FOREIGN KEY (id) REFERENCES nanos_platform (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE nanos_platform_instagram ADD CONSTRAINT FK_4EC99226BF396750 FOREIGN KEY (id) REFERENCES nanos_platform (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE nanos_platform DROP CONSTRAINT FK_AB32C2C36BF700BD');
        $this->addSql('ALTER TABLE nanos_campaign DROP CONSTRAINT FK_8D7500D56BF700BD');
        $this->addSql('ALTER TABLE nanos_campaign_platform DROP CONSTRAINT FK_557C6957F639F774');
        $this->addSql('ALTER TABLE nanos_campaign_platform DROP CONSTRAINT FK_557C6957FFE6496F');
        $this->addSql('ALTER TABLE nanos_platform_facebook DROP CONSTRAINT FK_B05AA711BF396750');
        $this->addSql('ALTER TABLE nanos_platform_adwords DROP CONSTRAINT FK_1311BD8BF396750');
        $this->addSql('ALTER TABLE nanos_platform_instagram DROP CONSTRAINT FK_4EC99226BF396750');
        $this->addSql('ALTER TABLE nanos_platform DROP CONSTRAINT FK_AB32C2C353B76128');
        $this->addSql('DROP SEQUENCE nanos_platform_status_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE nanos_campaign_status_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE nanos_campaign_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE nanos_platform_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE nanos_target_audience_id_seq CASCADE');
        $this->addSql('DROP TABLE nanos_platform_status');
        $this->addSql('DROP TABLE nanos_campaign_status');
        $this->addSql('DROP TABLE nanos_campaign');
        $this->addSql('DROP TABLE nanos_campaign_platform');
        $this->addSql('DROP TABLE nanos_platform');
        $this->addSql('DROP TABLE nanos_platform_facebook');
        $this->addSql('DROP TABLE nanos_platform_adwords');
        $this->addSql('DROP TABLE nanos_platform_instagram');
        $this->addSql('DROP TABLE nanos_target_audience');
    }
}
