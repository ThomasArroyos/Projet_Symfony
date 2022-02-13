<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220213172505 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE possibilite (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, periode INTEGER NOT NULL, disponibilite DATE NOT NULL)');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, identifiant CLOB NOT NULL, password CLOB NOT NULL)');
        $this->addSql('DROP TABLE disponibilite');
        $this->addSql('ALTER TABLE classe ADD COLUMN groupe_id INTEGER NOT NULL');
        $this->addSql('CREATE TEMPORARY TABLE __temp__formation AS SELECT id, nom_formation, date_debut_formation, date_fin_formation, matieres, duree_matiere FROM formation');
        $this->addSql('DROP TABLE formation');
        $this->addSql('CREATE TABLE formation (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom_formation CLOB NOT NULL COLLATE BINARY, date_debut_formation DATETIME NOT NULL, date_fin_formation DATETIME NOT NULL, matieres CLOB NOT NULL COLLATE BINARY, duree_matieres DOUBLE PRECISION NOT NULL, classes CLOB NOT NULL, periodes INTEGER NOT NULL, user_id INTEGER NOT NULL)');
        $this->addSql('INSERT INTO formation (id, nom_formation, date_debut_formation, date_fin_formation, matieres, duree_matieres) SELECT id, nom_formation, date_debut_formation, date_fin_formation, matieres, duree_matiere FROM __temp__formation');
        $this->addSql('DROP TABLE __temp__formation');
        $this->addSql('CREATE TEMPORARY TABLE __temp__groupe AS SELECT id_groupe, specialite FROM groupe');
        $this->addSql('DROP TABLE groupe');
        $this->addSql('CREATE TABLE groupe (id_groupe INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, specialite CLOB NOT NULL COLLATE BINARY)');
        $this->addSql('INSERT INTO groupe (id_groupe, specialite) SELECT id_groupe, specialite FROM __temp__groupe');
        $this->addSql('DROP TABLE __temp__groupe');
        $this->addSql('CREATE TEMPORARY TABLE __temp__intervenant AS SELECT id_intervenant, nom, prenom, heures_travaillees FROM intervenant');
        $this->addSql('DROP TABLE intervenant');
        $this->addSql('CREATE TABLE intervenant (id_intervenant INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom CLOB NOT NULL COLLATE BINARY, prenom CLOB NOT NULL COLLATE BINARY, heures_travaillees DOUBLE PRECISION NOT NULL, disponibilites DATE NOT NULL)');
        $this->addSql('INSERT INTO intervenant (id_intervenant, nom, prenom, heures_travaillees) SELECT id_intervenant, nom, prenom, heures_travaillees FROM __temp__intervenant');
        $this->addSql('DROP TABLE __temp__intervenant');
        $this->addSql('CREATE TEMPORARY TABLE __temp__matiere AS SELECT id_matiere, nom_matiere, duree_totale, intervenant_affecte FROM matiere');
        $this->addSql('DROP TABLE matiere');
        $this->addSql('CREATE TABLE matiere (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom_matiere CLOB NOT NULL COLLATE BINARY, duree_totale INTEGER NOT NULL, intervenant_affecte INTEGER NOT NULL, classe_id CLOB NOT NULL)');
        $this->addSql('INSERT INTO matiere (id, nom_matiere, duree_totale, intervenant_affecte) SELECT id_matiere, nom_matiere, duree_totale, intervenant_affecte FROM __temp__matiere');
        $this->addSql('DROP TABLE __temp__matiere');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE disponibilite (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, periode INTEGER NOT NULL, conflit_cours BOOLEAN NOT NULL)');
        $this->addSql('DROP TABLE possibilite');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TEMPORARY TABLE __temp__classe AS SELECT id_classe, libelle_classe, nb_eleve_total FROM classe');
        $this->addSql('DROP TABLE classe');
        $this->addSql('CREATE TABLE classe (id_classe INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, libelle_classe CLOB NOT NULL, nb_eleve_total INTEGER NOT NULL)');
        $this->addSql('INSERT INTO classe (id_classe, libelle_classe, nb_eleve_total) SELECT id_classe, libelle_classe, nb_eleve_total FROM __temp__classe');
        $this->addSql('DROP TABLE __temp__classe');
        $this->addSql('CREATE TEMPORARY TABLE __temp__formation AS SELECT id, nom_formation, date_debut_formation, date_fin_formation, matieres, duree_matieres FROM formation');
        $this->addSql('DROP TABLE formation');
        $this->addSql('CREATE TABLE formation (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom_formation CLOB NOT NULL, date_debut_formation DATETIME NOT NULL, date_fin_formation DATETIME NOT NULL, matieres CLOB NOT NULL, duree_matiere DOUBLE PRECISION NOT NULL, periodes_entreprise DATE NOT NULL, periodes_cours DATE NOT NULL)');
        $this->addSql('INSERT INTO formation (id, nom_formation, date_debut_formation, date_fin_formation, matieres, duree_matiere) SELECT id, nom_formation, date_debut_formation, date_fin_formation, matieres, duree_matieres FROM __temp__formation');
        $this->addSql('DROP TABLE __temp__formation');
        $this->addSql('ALTER TABLE groupe ADD COLUMN libelle_groupe CLOB NOT NULL COLLATE BINARY');
        $this->addSql('ALTER TABLE groupe ADD COLUMN libelle_classe CLOB NOT NULL COLLATE BINARY');
        $this->addSql('ALTER TABLE groupe ADD COLUMN nb_eleve_groupe INTEGER NOT NULL');
        $this->addSql('CREATE TEMPORARY TABLE __temp__intervenant AS SELECT id_intervenant, nom, prenom, heures_travaillees FROM intervenant');
        $this->addSql('DROP TABLE intervenant');
        $this->addSql('CREATE TABLE intervenant (id_intervenant INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom CLOB NOT NULL, prenom CLOB NOT NULL, heures_travaillees DOUBLE PRECISION NOT NULL, matieres_enseignees CLOB NOT NULL COLLATE BINARY, date_intervention DATETIME NOT NULL, duree_semaine_inter DOUBLE PRECISION NOT NULL, duree_inter_totale DOUBLE PRECISION NOT NULL, nom_matiere CLOB NOT NULL COLLATE BINARY)');
        $this->addSql('INSERT INTO intervenant (id_intervenant, nom, prenom, heures_travaillees) SELECT id_intervenant, nom, prenom, heures_travaillees FROM __temp__intervenant');
        $this->addSql('DROP TABLE __temp__intervenant');
        $this->addSql('CREATE TEMPORARY TABLE __temp__matiere AS SELECT id, nom_matiere, duree_totale, intervenant_affecte FROM matiere');
        $this->addSql('DROP TABLE matiere');
        $this->addSql('CREATE TABLE matiere (id_matiere INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom_matiere CLOB NOT NULL, duree_totale INTEGER NOT NULL, intervenant_affecte CLOB NOT NULL COLLATE BINARY, date_enseignement DATETIME NOT NULL)');
        $this->addSql('INSERT INTO matiere (id_matiere, nom_matiere, duree_totale, intervenant_affecte) SELECT id, nom_matiere, duree_totale, intervenant_affecte FROM __temp__matiere');
        $this->addSql('DROP TABLE __temp__matiere');
    }
}
