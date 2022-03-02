<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220302190446 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE calendar (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(100) NOT NULL, start DATETIME NOT NULL, end DATETIME NOT NULL, all_day TINYINT(1) NOT NULL, email VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE calendar_matiere (calendar_id INT NOT NULL, matiere_id INT NOT NULL, INDEX IDX_F2632C8DA40A2C8 (calendar_id), INDEX IDX_F2632C8DF46CD258 (matiere_id), PRIMARY KEY(calendar_id, matiere_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE classe (id INT AUTO_INCREMENT NOT NULL, nb_eleve_total INT NOT NULL, libelle_classe VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE classe_matiere (classe_id INT NOT NULL, matiere_id INT NOT NULL, INDEX IDX_EB8D372B8F5EA509 (classe_id), INDEX IDX_EB8D372BF46CD258 (matiere_id), PRIMARY KEY(classe_id, matiere_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE couleur (id INT AUTO_INCREMENT NOT NULL, background_color VARCHAR(7) NOT NULL, border_color VARCHAR(7) NOT NULL, color VARCHAR(7) NOT NULL, couleurName INT DEFAULT NULL, UNIQUE INDEX UNIQ_3C0D87E5610B6FFD (couleurName), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formation (id INT AUTO_INCREMENT NOT NULL, nom_formation VARCHAR(50) NOT NULL, date_debut_formation DATETIME NOT NULL, date_fin_formation DATETIME NOT NULL, duree_matieres DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formation_matiere (formation_id INT NOT NULL, matiere_id INT NOT NULL, INDEX IDX_D5EB12315200282E (formation_id), INDEX IDX_D5EB1231F46CD258 (matiere_id), PRIMARY KEY(formation_id, matiere_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formation_classe (formation_id INT NOT NULL, classe_id INT NOT NULL, INDEX IDX_AF9EB1BB5200282E (formation_id), INDEX IDX_AF9EB1BB8F5EA509 (classe_id), PRIMARY KEY(formation_id, classe_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE groupe (id INT AUTO_INCREMENT NOT NULL, calendar INT DEFAULT NULL, specialite VARCHAR(50) NOT NULL, classeId INT DEFAULT NULL, INDEX IDX_4B98C2156784FF4 (classeId), INDEX IDX_4B98C216EA9A146 (calendar), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE matiere (id INT AUTO_INCREMENT NOT NULL, duree_totale DOUBLE PRECISION NOT NULL, intervenant_affecte VARCHAR(50) NOT NULL, nom_matiere VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, calendrier_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D649FF52FC51 (calendrier_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_matiere (user_id INT NOT NULL, matiere_id INT NOT NULL, INDEX IDX_C8194940A76ED395 (user_id), INDEX IDX_C8194940F46CD258 (matiere_id), PRIMARY KEY(user_id, matiere_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE calendar_matiere ADD CONSTRAINT FK_F2632C8DA40A2C8 FOREIGN KEY (calendar_id) REFERENCES calendar (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE calendar_matiere ADD CONSTRAINT FK_F2632C8DF46CD258 FOREIGN KEY (matiere_id) REFERENCES matiere (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE classe_matiere ADD CONSTRAINT FK_EB8D372B8F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE classe_matiere ADD CONSTRAINT FK_EB8D372BF46CD258 FOREIGN KEY (matiere_id) REFERENCES matiere (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE couleur ADD CONSTRAINT FK_3C0D87E5610B6FFD FOREIGN KEY (couleurName) REFERENCES matiere (id)');
        $this->addSql('ALTER TABLE formation_matiere ADD CONSTRAINT FK_D5EB12315200282E FOREIGN KEY (formation_id) REFERENCES formation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE formation_matiere ADD CONSTRAINT FK_D5EB1231F46CD258 FOREIGN KEY (matiere_id) REFERENCES matiere (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE formation_classe ADD CONSTRAINT FK_AF9EB1BB5200282E FOREIGN KEY (formation_id) REFERENCES formation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE formation_classe ADD CONSTRAINT FK_AF9EB1BB8F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE groupe ADD CONSTRAINT FK_4B98C2156784FF4 FOREIGN KEY (classeId) REFERENCES classe (id)');
        $this->addSql('ALTER TABLE groupe ADD CONSTRAINT FK_4B98C216EA9A146 FOREIGN KEY (calendar) REFERENCES calendar (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649FF52FC51 FOREIGN KEY (calendrier_id) REFERENCES calendar (id)');
        $this->addSql('ALTER TABLE user_matiere ADD CONSTRAINT FK_C8194940A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_matiere ADD CONSTRAINT FK_C8194940F46CD258 FOREIGN KEY (matiere_id) REFERENCES matiere (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE calendar_matiere DROP FOREIGN KEY FK_F2632C8DA40A2C8');
        $this->addSql('ALTER TABLE groupe DROP FOREIGN KEY FK_4B98C216EA9A146');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649FF52FC51');
        $this->addSql('ALTER TABLE classe_matiere DROP FOREIGN KEY FK_EB8D372B8F5EA509');
        $this->addSql('ALTER TABLE formation_classe DROP FOREIGN KEY FK_AF9EB1BB8F5EA509');
        $this->addSql('ALTER TABLE groupe DROP FOREIGN KEY FK_4B98C2156784FF4');
        $this->addSql('ALTER TABLE formation_matiere DROP FOREIGN KEY FK_D5EB12315200282E');
        $this->addSql('ALTER TABLE formation_classe DROP FOREIGN KEY FK_AF9EB1BB5200282E');
        $this->addSql('ALTER TABLE calendar_matiere DROP FOREIGN KEY FK_F2632C8DF46CD258');
        $this->addSql('ALTER TABLE classe_matiere DROP FOREIGN KEY FK_EB8D372BF46CD258');
        $this->addSql('ALTER TABLE couleur DROP FOREIGN KEY FK_3C0D87E5610B6FFD');
        $this->addSql('ALTER TABLE formation_matiere DROP FOREIGN KEY FK_D5EB1231F46CD258');
        $this->addSql('ALTER TABLE user_matiere DROP FOREIGN KEY FK_C8194940F46CD258');
        $this->addSql('ALTER TABLE user_matiere DROP FOREIGN KEY FK_C8194940A76ED395');
        $this->addSql('DROP TABLE calendar');
        $this->addSql('DROP TABLE calendar_matiere');
        $this->addSql('DROP TABLE classe');
        $this->addSql('DROP TABLE classe_matiere');
        $this->addSql('DROP TABLE couleur');
        $this->addSql('DROP TABLE formation');
        $this->addSql('DROP TABLE formation_matiere');
        $this->addSql('DROP TABLE formation_classe');
        $this->addSql('DROP TABLE groupe');
        $this->addSql('DROP TABLE matiere');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_matiere');
    }
}
