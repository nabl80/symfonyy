<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210727215159 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE property DROP FOREIGN KEY FK_8BF21CDE549213EC');
        $this->addSql('DROP INDEX UNIQ_8BF21CDE549213EC ON property');
        $this->addSql('ALTER TABLE property ADD password VARCHAR(255) NOT NULL, DROP property_id');
        $this->addSql('ALTER TABLE user ADD user VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE property ADD property_id INT NOT NULL, DROP password');
        $this->addSql('ALTER TABLE property ADD CONSTRAINT FK_8BF21CDE549213EC FOREIGN KEY (property_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8BF21CDE549213EC ON property (property_id)');
        $this->addSql('ALTER TABLE user DROP user');
    }
}
