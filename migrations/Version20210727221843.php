<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210727221843 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_8BF21CDE3E4A79C1 ON property');
        $this->addSql('DROP INDEX UNIQ_8BF21CDEA832C1C9 ON property');
        $this->addSql('ALTER TABLE property DROP email_id, DROP password_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE property ADD email_id INT NOT NULL, ADD password_id INT NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8BF21CDE3E4A79C1 ON property (password_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8BF21CDEA832C1C9 ON property (email_id)');
    }
}
