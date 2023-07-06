<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230701101022 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE messenger_messages (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, body CLOB NOT NULL, headers CLOB NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('DROP TABLE goal5');
        $this->addSql('DROP TABLE goal_tables');
        $this->addSql('DROP TABLE milestones');
        $this->addSql('DROP TABLE statistics');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE goal5 (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(100) NOT NULL COLLATE "BINARY")');
        $this->addSql('CREATE TABLE goal_tables (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, indicator VARCHAR(100) NOT NULL COLLATE "BINARY", table_code VARCHAR(10) NOT NULL COLLATE "BINARY")');
        $this->addSql('CREATE TABLE milestones (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, code VARCHAR(10) NOT NULL COLLATE "BINARY", number VARCHAR(3) NOT NULL COLLATE "BINARY", name VARCHAR(150) NOT NULL COLLATE "BINARY", description VARCHAR(500) NOT NULL COLLATE "BINARY")');
        $this->addSql('CREATE TABLE statistics (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, code VARCHAR(10) NOT NULL COLLATE "BINARY", year INTEGER NOT NULL, women INTEGER NOT NULL, men INTEGER NOT NULL, difference INTEGER DEFAULT NULL, category VARCHAR(50) DEFAULT NULL COLLATE "BINARY")');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
