<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210802223002 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE property DROP FOREIGN KEY FK_8BF21CDEA832C1C9');
        $this->addSql('DROP INDEX UNIQ_8BF21CDEA832C1C9 ON property');
        $this->addSql('ALTER TABLE property DROP email_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE property ADD email_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE property ADD CONSTRAINT FK_8BF21CDEA832C1C9 FOREIGN KEY (email_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8BF21CDEA832C1C9 ON property (email_id)');
    }
}
