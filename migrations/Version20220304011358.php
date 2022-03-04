<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220304011358 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE eleve ADD specialite_id INT DEFAULT NULL, ADD formation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE eleve ADD CONSTRAINT FK_ECA105F72195E0F0 FOREIGN KEY (specialite_id) REFERENCES specialite (id)');
        $this->addSql('ALTER TABLE eleve ADD CONSTRAINT FK_ECA105F75200282E FOREIGN KEY (formation_id) REFERENCES formation (id)');
        $this->addSql('CREATE INDEX IDX_ECA105F72195E0F0 ON eleve (specialite_id)');
        $this->addSql('CREATE INDEX IDX_ECA105F75200282E ON eleve (formation_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE eleve DROP FOREIGN KEY FK_ECA105F72195E0F0');
        $this->addSql('ALTER TABLE eleve DROP FOREIGN KEY FK_ECA105F75200282E');
        $this->addSql('DROP INDEX IDX_ECA105F72195E0F0 ON eleve');
        $this->addSql('DROP INDEX IDX_ECA105F75200282E ON eleve');
        $this->addSql('ALTER TABLE eleve DROP specialite_id, DROP formation_id');
    }
}
