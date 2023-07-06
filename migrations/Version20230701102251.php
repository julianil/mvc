<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230701102251 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE goal5 (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(100) NOT NULL)');
        $this->addSql('CREATE TABLE goal_tables (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, indicator VARCHAR(100) NOT NULL, table_code VARCHAR(10) NOT NULL)');
        $this->addSql('CREATE TABLE library (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, isbn VARCHAR(50) NOT NULL, writer VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, description VARCHAR(1000) DEFAULT NULL)');
        $this->addSql('CREATE TABLE milestones (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, code VARCHAR(10) NOT NULL, number VARCHAR(3) NOT NULL, name VARCHAR(150) NOT NULL, description VARCHAR(500) NOT NULL)');
        $this->addSql('CREATE TABLE product (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, value INTEGER DEFAULT NULL)');
        $this->addSql('CREATE TABLE statistics (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, code VARCHAR(10) NOT NULL, year INTEGER NOT NULL, women INTEGER NOT NULL, men INTEGER NOT NULL, difference INTEGER DEFAULT NULL, category VARCHAR(50) DEFAULT NULL)');
        $this->addSql('CREATE TABLE messenger_messages (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, body CLOB NOT NULL, headers CLOB NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE goal5');
        $this->addSql('DROP TABLE goal_tables');
        $this->addSql('DROP TABLE library');
        $this->addSql('DROP TABLE milestones');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE statistics');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
