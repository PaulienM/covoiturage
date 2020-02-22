<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200221182457 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE trajet (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, places VARCHAR(255) NOT NULL, datetime DATETIME NOT NULL, lieu_depart_id INTEGER DEFAULT NULL, lieu_arrivee_id INTEGER DEFAULT NULL, conducteur_id INTEGER DEFAULT NULL, user_id INTEGER DEFAULT NULL)');
        $this->addSql('CREATE TABLE trajet_user (trajet_id INTEGER NOT NULL, user_id INTEGER NOT NULL, PRIMARY KEY(trajet_id, user_id))');
        $this->addSql('CREATE TABLE lieu (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, longitude DOUBLE PRECISION NOT NULL, latitude DOUBLE PRECISION NOT NULL)');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE trajet');
        $this->addSql('DROP TABLE trajet_user');
        $this->addSql('DROP TABLE lieu');
        $this->addSql('DROP TABLE user');
    }
}
