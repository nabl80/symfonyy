<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210805153209 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE administrator DROP FOREIGN KEY FK_58DF065171179CD6');
        $this->addSql('DROP INDEX UNIQ_58DF065171179CD6 ON administrator');
        $this->addSql('ALTER TABLE administrator ADD name VARCHAR(255) DEFAULT NULL, ADD surname VARCHAR(255) DEFAULT NULL, DROP name_id');
        $this->addSql('ALTER TABLE user ADD adm_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6494E949F2D FOREIGN KEY (adm_id) REFERENCES administrator (id)');
        $this->addSql('CREATE INDEX IDX_8D93D6494E949F2D ON user (adm_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE administrator ADD name_id INT DEFAULT NULL, DROP name, DROP surname');
        $this->addSql('ALTER TABLE administrator ADD CONSTRAINT FK_58DF065171179CD6 FOREIGN KEY (name_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_58DF065171179CD6 ON administrator (name_id)');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6494E949F2D');
        $this->addSql('DROP INDEX IDX_8D93D6494E949F2D ON user');
        $this->addSql('ALTER TABLE user DROP adm_id');
    }
}
