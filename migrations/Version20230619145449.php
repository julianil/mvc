<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230619145449 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE milestones (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, number VARCHAR(3) NOT NULL, name VARCHAR(150) NOT NULL, description VARCHAR(500) NOT NULL)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__library AS SELECT id, name, isbn, writer, image, description FROM library');
        $this->addSql('DROP TABLE library');
        $this->addSql('CREATE TABLE library (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, isbn VARCHAR(50) NOT NULL, writer VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, description VARCHAR(1000) DEFAULT NULL)');
        $this->addSql('INSERT INTO library (id, name, isbn, writer, image, description) SELECT id, name, isbn, writer, image, description FROM __temp__library');
        $this->addSql('DROP TABLE __temp__library');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE milestones');
        $this->addSql('CREATE TEMPORARY TABLE __temp__library AS SELECT id, name, isbn, writer, image, description FROM library');
        $this->addSql('DROP TABLE library');
        $this->addSql('CREATE TABLE library (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, isbn INTEGER NOT NULL, writer VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, description VARCHAR(1000) DEFAULT NULL)');
        $this->addSql('INSERT INTO library (id, name, isbn, writer, image, description) SELECT id, name, isbn, writer, image, description FROM __temp__library');
        $this->addSql('DROP TABLE __temp__library');
    }
}
