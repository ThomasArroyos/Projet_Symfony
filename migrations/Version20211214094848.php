<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211214094848 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE classe (id_classe INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, libelle CLOB NOT NULL, specialite CLOB NOT NULL)');
        $this->addSql('CREATE TABLE groupe (id_groupe INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, libelle CLOB NOT NULL)');
        $this->addSql('CREATE TABLE intervenant (id_intervenant INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom CLOB NOT NULL, prenom CLOB NOT NULL, heures_travaillees DOUBLE PRECISION NOT NULL)');
        $this->addSql('CREATE TABLE matiere (id_matiere INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom_matiere CLOB NOT NULL, duree_totale INTEGER NOT NULL)');
        $this->addSql('CREATE TABLE seance (id_seance INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, date_cours DATETIME NOT NULL, duree DOUBLE PRECISION NOT NULL)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE classe');
        $this->addSql('DROP TABLE groupe');
        $this->addSql('DROP TABLE intervenant');
        $this->addSql('DROP TABLE matiere');
        $this->addSql('DROP TABLE seance');
    }
}
