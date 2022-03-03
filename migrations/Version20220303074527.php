<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220303074527 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE couleur (id INT AUTO_INCREMENT NOT NULL, fond VARCHAR(7) NOT NULL, bordure VARCHAR(7) NOT NULL, texte VARCHAR(7) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE eleve (id INT AUTO_INCREMENT NOT NULL, compte_id INT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, telephone VARCHAR(12) NOT NULL, UNIQUE INDEX UNIQ_ECA105F7F2C56620 (compte_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evenement (id INT AUTO_INCREMENT NOT NULL, intervenant_id INT DEFAULT NULL, matiere_id INT DEFAULT NULL, specialite_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, date_debut DATETIME NOT NULL, date_fin DATETIME DEFAULT NULL, journee_entiere TINYINT(1) NOT NULL, chevaucher TINYINT(1) NOT NULL, modifiable TINYINT(1) NOT NULL, accepte TINYINT(1) NOT NULL, en_fond VARCHAR(255) NOT NULL, INDEX IDX_B26681EAB9A1716 (intervenant_id), INDEX IDX_B26681EF46CD258 (matiere_id), INDEX IDX_B26681E2195E0F0 (specialite_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formation (id INT AUTO_INCREMENT NOT NULL, libele VARCHAR(255) NOT NULL, date_debut DATETIME NOT NULL, date_fin DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formation_specialite (formation_id INT NOT NULL, specialite_id INT NOT NULL, INDEX IDX_1F7E2FF85200282E (formation_id), INDEX IDX_1F7E2FF82195E0F0 (specialite_id), PRIMARY KEY(formation_id, specialite_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE intervenant (id INT AUTO_INCREMENT NOT NULL, compte_id INT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, telephone VARCHAR(12) DEFAULT NULL, UNIQUE INDEX UNIQ_73D0145CF2C56620 (compte_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE intervenant_matiere (intervenant_id INT NOT NULL, matiere_id INT NOT NULL, INDEX IDX_D9086E53AB9A1716 (intervenant_id), INDEX IDX_D9086E53F46CD258 (matiere_id), PRIMARY KEY(intervenant_id, matiere_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE intervenant_specialite (intervenant_id INT NOT NULL, specialite_id INT NOT NULL, INDEX IDX_EEA4B582AB9A1716 (intervenant_id), INDEX IDX_EEA4B5822195E0F0 (specialite_id), PRIMARY KEY(intervenant_id, specialite_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE intervenant_formation (intervenant_id INT NOT NULL, formation_id INT NOT NULL, INDEX IDX_844549B3AB9A1716 (intervenant_id), INDEX IDX_844549B35200282E (formation_id), PRIMARY KEY(intervenant_id, formation_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE matiere (id INT AUTO_INCREMENT NOT NULL, couleur_id INT NOT NULL, libele VARCHAR(255) NOT NULL, duree INT NOT NULL, UNIQUE INDEX UNIQ_9014574AC31BA576 (couleur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE specialite (id INT AUTO_INCREMENT NOT NULL, libele VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE specialite_matiere (specialite_id INT NOT NULL, matiere_id INT NOT NULL, INDEX IDX_AF1D45CE2195E0F0 (specialite_id), INDEX IDX_AF1D45CEF46CD258 (matiere_id), PRIMARY KEY(specialite_id, matiere_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE eleve ADD CONSTRAINT FK_ECA105F7F2C56620 FOREIGN KEY (compte_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT FK_B26681EAB9A1716 FOREIGN KEY (intervenant_id) REFERENCES intervenant (id)');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT FK_B26681EF46CD258 FOREIGN KEY (matiere_id) REFERENCES matiere (id)');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT FK_B26681E2195E0F0 FOREIGN KEY (specialite_id) REFERENCES specialite (id)');
        $this->addSql('ALTER TABLE formation_specialite ADD CONSTRAINT FK_1F7E2FF85200282E FOREIGN KEY (formation_id) REFERENCES formation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE formation_specialite ADD CONSTRAINT FK_1F7E2FF82195E0F0 FOREIGN KEY (specialite_id) REFERENCES specialite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE intervenant ADD CONSTRAINT FK_73D0145CF2C56620 FOREIGN KEY (compte_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE intervenant_matiere ADD CONSTRAINT FK_D9086E53AB9A1716 FOREIGN KEY (intervenant_id) REFERENCES intervenant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE intervenant_matiere ADD CONSTRAINT FK_D9086E53F46CD258 FOREIGN KEY (matiere_id) REFERENCES matiere (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE intervenant_specialite ADD CONSTRAINT FK_EEA4B582AB9A1716 FOREIGN KEY (intervenant_id) REFERENCES intervenant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE intervenant_specialite ADD CONSTRAINT FK_EEA4B5822195E0F0 FOREIGN KEY (specialite_id) REFERENCES specialite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE intervenant_formation ADD CONSTRAINT FK_844549B3AB9A1716 FOREIGN KEY (intervenant_id) REFERENCES intervenant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE intervenant_formation ADD CONSTRAINT FK_844549B35200282E FOREIGN KEY (formation_id) REFERENCES formation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE matiere ADD CONSTRAINT FK_9014574AC31BA576 FOREIGN KEY (couleur_id) REFERENCES couleur (id)');
        $this->addSql('ALTER TABLE specialite_matiere ADD CONSTRAINT FK_AF1D45CE2195E0F0 FOREIGN KEY (specialite_id) REFERENCES specialite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE specialite_matiere ADD CONSTRAINT FK_AF1D45CEF46CD258 FOREIGN KEY (matiere_id) REFERENCES matiere (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE matiere DROP FOREIGN KEY FK_9014574AC31BA576');
        $this->addSql('ALTER TABLE formation_specialite DROP FOREIGN KEY FK_1F7E2FF85200282E');
        $this->addSql('ALTER TABLE intervenant_formation DROP FOREIGN KEY FK_844549B35200282E');
        $this->addSql('ALTER TABLE evenement DROP FOREIGN KEY FK_B26681EAB9A1716');
        $this->addSql('ALTER TABLE intervenant_matiere DROP FOREIGN KEY FK_D9086E53AB9A1716');
        $this->addSql('ALTER TABLE intervenant_specialite DROP FOREIGN KEY FK_EEA4B582AB9A1716');
        $this->addSql('ALTER TABLE intervenant_formation DROP FOREIGN KEY FK_844549B3AB9A1716');
        $this->addSql('ALTER TABLE evenement DROP FOREIGN KEY FK_B26681EF46CD258');
        $this->addSql('ALTER TABLE intervenant_matiere DROP FOREIGN KEY FK_D9086E53F46CD258');
        $this->addSql('ALTER TABLE specialite_matiere DROP FOREIGN KEY FK_AF1D45CEF46CD258');
        $this->addSql('ALTER TABLE evenement DROP FOREIGN KEY FK_B26681E2195E0F0');
        $this->addSql('ALTER TABLE formation_specialite DROP FOREIGN KEY FK_1F7E2FF82195E0F0');
        $this->addSql('ALTER TABLE intervenant_specialite DROP FOREIGN KEY FK_EEA4B5822195E0F0');
        $this->addSql('ALTER TABLE specialite_matiere DROP FOREIGN KEY FK_AF1D45CE2195E0F0');
        $this->addSql('ALTER TABLE eleve DROP FOREIGN KEY FK_ECA105F7F2C56620');
        $this->addSql('ALTER TABLE intervenant DROP FOREIGN KEY FK_73D0145CF2C56620');
        $this->addSql('DROP TABLE couleur');
        $this->addSql('DROP TABLE eleve');
        $this->addSql('DROP TABLE evenement');
        $this->addSql('DROP TABLE formation');
        $this->addSql('DROP TABLE formation_specialite');
        $this->addSql('DROP TABLE intervenant');
        $this->addSql('DROP TABLE intervenant_matiere');
        $this->addSql('DROP TABLE intervenant_specialite');
        $this->addSql('DROP TABLE intervenant_formation');
        $this->addSql('DROP TABLE matiere');
        $this->addSql('DROP TABLE specialite');
        $this->addSql('DROP TABLE specialite_matiere');
        $this->addSql('DROP TABLE user');
    }
}
