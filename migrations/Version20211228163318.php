<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211228163318 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE disponibilite (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, periode INTEGER NOT NULL, conflit_cours BOOLEAN NOT NULL)');
        $this->addSql('CREATE TABLE formation (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom_formation CLOB NOT NULL, date_debut_formation DATETIME NOT NULL, date_fin_formation DATETIME NOT NULL, matieres CLOB NOT NULL, duree_matiere DOUBLE PRECISION NOT NULL, periodes_entreprise DATE NOT NULL, periodes_cours DATE NOT NULL)');
        $this->addSql('DROP TABLE seance');
        $this->addSql('CREATE TEMPORARY TABLE __temp__classe AS SELECT id_classe FROM classe');
        $this->addSql('DROP TABLE classe');
        $this->addSql('CREATE TABLE classe (id_classe INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, libelle_classe CLOB NOT NULL, nb_eleve_total INTEGER NOT NULL)');
        $this->addSql('INSERT INTO classe (id_classe) SELECT id_classe FROM __temp__classe');
        $this->addSql('DROP TABLE __temp__classe');
        $this->addSql('CREATE TEMPORARY TABLE __temp__groupe AS SELECT id_groupe, libelle FROM groupe');
        $this->addSql('DROP TABLE groupe');
        $this->addSql('CREATE TABLE groupe (id_groupe INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, libelle_groupe CLOB NOT NULL, libelle_classe CLOB NOT NULL, specialite CLOB NOT NULL, nb_eleve_groupe INTEGER NOT NULL)');
        $this->addSql('INSERT INTO groupe (id_groupe, libelle_groupe) SELECT id_groupe, libelle FROM __temp__groupe');
        $this->addSql('DROP TABLE __temp__groupe');
        $this->addSql('ALTER TABLE intervenant ADD COLUMN matieres_enseignees CLOB NOT NULL');
        $this->addSql('ALTER TABLE intervenant ADD COLUMN date_intervention DATETIME NOT NULL');
        $this->addSql('ALTER TABLE intervenant ADD COLUMN duree_semaine_inter DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE intervenant ADD COLUMN duree_inter_totale DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE intervenant ADD COLUMN nom_matiere CLOB NOT NULL');
        $this->addSql('ALTER TABLE matiere ADD COLUMN intervenant_affecte CLOB NOT NULL');
        $this->addSql('ALTER TABLE matiere ADD COLUMN date_enseignement DATETIME NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE seance (id_seance INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, date_cours DATETIME NOT NULL, duree DOUBLE PRECISION NOT NULL)');
        $this->addSql('DROP TABLE disponibilite');
        $this->addSql('DROP TABLE formation');
        $this->addSql('CREATE TEMPORARY TABLE __temp__classe AS SELECT id_classe, libelle_classe FROM classe');
        $this->addSql('DROP TABLE classe');
        $this->addSql('CREATE TABLE classe (id_classe INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, libelle CLOB NOT NULL COLLATE BINARY, specialite CLOB NOT NULL COLLATE BINARY)');
        $this->addSql('INSERT INTO classe (id_classe, libelle) SELECT id_classe, libelle_classe FROM __temp__classe');
        $this->addSql('DROP TABLE __temp__classe');
        $this->addSql('CREATE TEMPORARY TABLE __temp__groupe AS SELECT id_groupe FROM groupe');
        $this->addSql('DROP TABLE groupe');
        $this->addSql('CREATE TABLE groupe (id_groupe INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, libelle CLOB NOT NULL COLLATE BINARY)');
        $this->addSql('INSERT INTO groupe (id_groupe) SELECT id_groupe FROM __temp__groupe');
        $this->addSql('DROP TABLE __temp__groupe');
        $this->addSql('CREATE TEMPORARY TABLE __temp__intervenant AS SELECT id_intervenant, nom, prenom, heures_travaillees FROM intervenant');
        $this->addSql('DROP TABLE intervenant');
        $this->addSql('CREATE TABLE intervenant (id_intervenant INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom CLOB NOT NULL, prenom CLOB NOT NULL, heures_travaillees DOUBLE PRECISION NOT NULL)');
        $this->addSql('INSERT INTO intervenant (id_intervenant, nom, prenom, heures_travaillees) SELECT id_intervenant, nom, prenom, heures_travaillees FROM __temp__intervenant');
        $this->addSql('DROP TABLE __temp__intervenant');
        $this->addSql('CREATE TEMPORARY TABLE __temp__matiere AS SELECT id_matiere, nom_matiere, duree_totale FROM matiere');
        $this->addSql('DROP TABLE matiere');
        $this->addSql('CREATE TABLE matiere (id_matiere INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom_matiere CLOB NOT NULL, duree_totale INTEGER NOT NULL)');
        $this->addSql('INSERT INTO matiere (id_matiere, nom_matiere, duree_totale) SELECT id_matiere, nom_matiere, duree_totale FROM __temp__matiere');
        $this->addSql('DROP TABLE __temp__matiere');
    }
}
