<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200506161406 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, fullname VARCHAR(255) DEFAULT NULL, username VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, location VARCHAR(255) NOT NULL, reputation INT DEFAULT NULL, payment VARCHAR(255) DEFAULT NULL, photo VARCHAR(255) DEFAULT NULL, date_created DATETIME NOT NULL, date_modified DATETIME NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bundle (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, format VARCHAR(255) DEFAULT NULL, condition_rating VARCHAR(255) DEFAULT NULL, cover VARCHAR(255) DEFAULT NULL, listed TINYINT(1) NOT NULL, date_created DATETIME NOT NULL, date_modified DATETIME NOT NULL, INDEX IDX_A57B32FDA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE item (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, bundle_id INT DEFAULT NULL, format VARCHAR(255) NOT NULL, genre1 VARCHAR(255) DEFAULT NULL, genre2 VARCHAR(255) DEFAULT NULL, region VARCHAR(255) DEFAULT NULL, release_date INT DEFAULT NULL, publisher VARCHAR(255) DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, condition_rating INT DEFAULT NULL, price INT DEFAULT NULL, photo VARCHAR(255) DEFAULT NULL, cover VARCHAR(255) DEFAULT NULL, date_created DATETIME NOT NULL, date_modified DATETIME NOT NULL, INDEX IDX_1F1B251EA76ED395 (user_id), INDEX IDX_1F1B251EF1FAD9D3 (bundle_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bundle ADD CONSTRAINT FK_A57B32FDA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE item ADD CONSTRAINT FK_1F1B251EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE item ADD CONSTRAINT FK_1F1B251EF1FAD9D3 FOREIGN KEY (bundle_id) REFERENCES bundle (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE bundle DROP FOREIGN KEY FK_A57B32FDA76ED395');
        $this->addSql('ALTER TABLE item DROP FOREIGN KEY FK_1F1B251EA76ED395');
        $this->addSql('ALTER TABLE item DROP FOREIGN KEY FK_1F1B251EF1FAD9D3');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE bundle');
        $this->addSql('DROP TABLE item');
    }
}
