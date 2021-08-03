<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210802225625 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE news DROP FOREIGN KEY FK_1DD39950DEB3FFBD');
        $this->addSql('DROP INDEX IDX_1DD39950DEB3FFBD ON news');
        $this->addSql('ALTER TABLE news DROP prop_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE news ADD prop_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE news ADD CONSTRAINT FK_1DD39950DEB3FFBD FOREIGN KEY (prop_id) REFERENCES property (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_1DD39950DEB3FFBD ON news (prop_id)');
    }
}
