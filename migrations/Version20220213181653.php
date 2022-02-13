<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220213181653 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TEMPORARY TABLE __temp__formation AS SELECT id, nom_formation, date_debut_formation, date_fin_formation, matieres, duree_matieres, classes, periodes FROM formation');
        $this->addSql('DROP TABLE formation');
        $this->addSql('CREATE TABLE formation (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom_formation CLOB NOT NULL COLLATE BINARY, date_debut_formation DATETIME NOT NULL, date_fin_formation DATETIME NOT NULL, matieres CLOB NOT NULL COLLATE BINARY, duree_matieres DOUBLE PRECISION NOT NULL, classes CLOB NOT NULL COLLATE BINARY, periodes INTEGER NOT NULL)');
        $this->addSql('INSERT INTO formation (id, nom_formation, date_debut_formation, date_fin_formation, matieres, duree_matieres, classes, periodes) SELECT id, nom_formation, date_debut_formation, date_fin_formation, matieres, duree_matieres, classes, periodes FROM __temp__formation');
        $this->addSql('DROP TABLE __temp__formation');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, identifiant CLOB NOT NULL COLLATE BINARY, password CLOB NOT NULL COLLATE BINARY, email CLOB NOT NULL COLLATE BINARY, is_active BOOLEAN NOT NULL)');
        $this->addSql('ALTER TABLE formation ADD COLUMN user_id INTEGER NOT NULL');
    }
}
