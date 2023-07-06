<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230629114700 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE child_care (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, year INTEGER NOT NULL, women INTEGER NOT NULL, men INTEGER NOT NULL)');
        $this->addSql('CREATE TABLE lonutveckling (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, year INTEGER NOT NULL, women INTEGER NOT NULL, men INTEGER NOT NULL, difference INTEGER DEFAULT NULL)');
        $this->addSql('CREATE TABLE payed_leave (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, year INTEGER NOT NULL, women INTEGER NOT NULL, men INTEGER NOT NULL)');
        $this->addSql('DROP TABLE economy');
        $this->addSql('DROP TABLE education');
        $this->addSql('DROP TABLE homelabor');
        $this->addSql('CREATE TEMPORARY TABLE __temp__milestones AS SELECT id, number, name, description FROM milestones');
        $this->addSql('DROP TABLE milestones');
        $this->addSql('CREATE TABLE milestones (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, number VARCHAR(3) NOT NULL, name VARCHAR(150) NOT NULL, description VARCHAR(500) NOT NULL)');
        $this->addSql('INSERT INTO milestones (id, number, name, description) SELECT id, number, name, description FROM __temp__milestones');
        $this->addSql('DROP TABLE __temp__milestones');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE economy (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, type VARCHAR(10) NOT NULL COLLATE "BINARY", year INTEGER NOT NULL, women INTEGER NOT NULL, men INTEGER NOT NULL, difference INTEGER DEFAULT NULL)');
        $this->addSql('CREATE TABLE education (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, type VARCHAR(10) NOT NULL COLLATE "BINARY", year INTEGER NOT NULL, women INTEGER NOT NULL, men INTEGER NOT NULL, category VARCHAR(50) NOT NULL COLLATE "BINARY")');
        $this->addSql('CREATE TABLE homelabor (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, type VARCHAR(10) NOT NULL COLLATE "BINARY", year INTEGER NOT NULL, women INTEGER NOT NULL, men INTEGER NOT NULL, category VARCHAR(50) NOT NULL COLLATE "BINARY")');
        $this->addSql('DROP TABLE child_care');
        $this->addSql('DROP TABLE lonutveckling');
        $this->addSql('DROP TABLE payed_leave');
        $this->addSql('ALTER TABLE milestones ADD COLUMN type VARCHAR(10) NOT NULL');
    }
}
