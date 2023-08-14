<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230814023754 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__article AS SELECT article_id, title, author, description, url, image_url, content, tags FROM article');
        $this->addSql('DROP TABLE article');
        $this->addSql('CREATE TABLE article (article_id VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, author VARCHAR(255) DEFAULT NULL, description CLOB NOT NULL, url VARCHAR(255) NOT NULL, image_url VARCHAR(255) DEFAULT NULL, content CLOB NOT NULL, tags CLOB NOT NULL --(DC2Type:simple_array)
        , PRIMARY KEY(article_id))');
        $this->addSql('INSERT INTO article (article_id, title, author, description, url, image_url, content, tags) SELECT article_id, title, author, description, url, image_url, content, tags FROM __temp__article');
        $this->addSql('DROP TABLE __temp__article');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__article AS SELECT article_id, title, author, description, url, image_url, content, tags FROM article');
        $this->addSql('DROP TABLE article');
        $this->addSql('CREATE TABLE article (article_id VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, author VARCHAR(255) NOT NULL, description CLOB NOT NULL, url VARCHAR(255) NOT NULL, image_url VARCHAR(255) NOT NULL, content CLOB NOT NULL, tags CLOB NOT NULL --(DC2Type:simple_array)
        )');
        $this->addSql('INSERT INTO article (article_id, title, author, description, url, image_url, content, tags) SELECT article_id, title, author, description, url, image_url, content, tags FROM __temp__article');
        $this->addSql('DROP TABLE __temp__article');
    }
}
