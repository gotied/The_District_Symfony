<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230605224444 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT DEFAULT NULL, date_commande DATE NOT NULL, total NUMERIC(6, 2) NOT NULL, etat INT NOT NULL, INDEX IDX_6EEAA67DFB88E14F (utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE detail (id INT AUTO_INCREMENT NOT NULL, plat_id INT DEFAULT NULL, commande_id INT DEFAULT NULL, quantite INT NOT NULL, INDEX IDX_2E067F93D73DB560 (plat_id), INDEX IDX_2E067F9382EA2E54 (commande_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(50) NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, telephone VARCHAR(20) NOT NULL, adresse VARCHAR(50) NOT NULL, cp VARCHAR(20) NOT NULL, ville VARCHAR(50) NOT NULL, roles VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE detail ADD CONSTRAINT FK_2E067F93D73DB560 FOREIGN KEY (plat_id) REFERENCES plat (id)');
        $this->addSql('ALTER TABLE detail ADD CONSTRAINT FK_2E067F9382EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE plat ADD categorie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE plat ADD CONSTRAINT FK_2038A207BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX IDX_2038A207BCF5E72D ON plat (categorie_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DFB88E14F');
        $this->addSql('ALTER TABLE detail DROP FOREIGN KEY FK_2E067F93D73DB560');
        $this->addSql('ALTER TABLE detail DROP FOREIGN KEY FK_2E067F9382EA2E54');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE detail');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('ALTER TABLE plat DROP FOREIGN KEY FK_2038A207BCF5E72D');
        $this->addSql('DROP INDEX IDX_2038A207BCF5E72D ON plat');
        $this->addSql('ALTER TABLE plat DROP categorie_id');
    }
}
