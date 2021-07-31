<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210727222848 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE property DROP FOREIGN KEY property_user__fk');
        $this->addSql('DROP INDEX property_user__fk ON property');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE property ADD CONSTRAINT property_user__fk FOREIGN KEY (email) REFERENCES user (email) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX property_user__fk ON property (email)');
    }
}
