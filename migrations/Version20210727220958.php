<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210727220958 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE property ADD email_id INT NOT NULL, ADD password_id INT NOT NULL');
        $this->addSql('ALTER TABLE property ADD CONSTRAINT FK_8BF21CDEA832C1C9 FOREIGN KEY (email_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE property ADD CONSTRAINT FK_8BF21CDE3E4A79C1 FOREIGN KEY (password_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8BF21CDEA832C1C9 ON property (email_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8BF21CDE3E4A79C1 ON property (password_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE property DROP FOREIGN KEY FK_8BF21CDEA832C1C9');
        $this->addSql('ALTER TABLE property DROP FOREIGN KEY FK_8BF21CDE3E4A79C1');
        $this->addSql('DROP INDEX UNIQ_8BF21CDEA832C1C9 ON property');
        $this->addSql('DROP INDEX UNIQ_8BF21CDE3E4A79C1 ON property');
        $this->addSql('ALTER TABLE property DROP email_id, DROP password_id');
    }
}
