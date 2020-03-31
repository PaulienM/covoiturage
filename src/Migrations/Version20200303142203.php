<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200303142203 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TEMPORARY TABLE __temp__trajet AS SELECT id, places, datetime, lieu_depart_id, lieu_arrivee_id, conducteur_id FROM trajet');
        $this->addSql('DROP TABLE trajet');
        $this->addSql('CREATE TABLE trajet (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, places VARCHAR(255) NOT NULL COLLATE BINARY, datetime DATETIME NOT NULL, lieu_depart_id INTEGER DEFAULT NULL, lieu_arrivee_id INTEGER DEFAULT NULL, conducteur_id INTEGER DEFAULT NULL)');
        $this->addSql('INSERT INTO trajet (id, places, datetime, lieu_depart_id, lieu_arrivee_id, conducteur_id) SELECT id, places, datetime, lieu_depart_id, lieu_arrivee_id, conducteur_id FROM __temp__trajet');
        $this->addSql('DROP TABLE __temp__trajet');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('ALTER TABLE trajet ADD COLUMN user_id INTEGER DEFAULT NULL');
    }
}
