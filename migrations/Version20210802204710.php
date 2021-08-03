<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210802204710 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE agency ADD role_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE agency ADD CONSTRAINT FK_70C0C6E6D60322AC FOREIGN KEY (role_id) REFERENCES role (id)');
        $this->addSql('CREATE INDEX IDX_70C0C6E6D60322AC ON agency (role_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE agency DROP FOREIGN KEY FK_70C0C6E6D60322AC');
        $this->addSql('DROP INDEX IDX_70C0C6E6D60322AC ON agency');
        $this->addSql('ALTER TABLE agency DROP role_id');
    }
}
