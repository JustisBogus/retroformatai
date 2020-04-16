<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200416091053 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE bundle (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, format VARCHAR(255) NOT NULL, condition_rating VARCHAR(255) DEFAULT NULL, cover VARCHAR(255) DEFAULT NULL, date_created DATETIME NOT NULL, date_modified DATETIME NOT NULL, INDEX IDX_A57B32FDA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bundle ADD CONSTRAINT FK_A57B32FDA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE item ADD user_id INT DEFAULT NULL, ADD bundle_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE item ADD CONSTRAINT FK_1F1B251EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE item ADD CONSTRAINT FK_1F1B251EF1FAD9D3 FOREIGN KEY (bundle_id) REFERENCES bundle (id)');
        $this->addSql('CREATE INDEX IDX_1F1B251EA76ED395 ON item (user_id)');
        $this->addSql('CREATE INDEX IDX_1F1B251EF1FAD9D3 ON item (bundle_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE item DROP FOREIGN KEY FK_1F1B251EF1FAD9D3');
        $this->addSql('DROP TABLE bundle');
        $this->addSql('ALTER TABLE item DROP FOREIGN KEY FK_1F1B251EA76ED395');
        $this->addSql('DROP INDEX IDX_1F1B251EA76ED395 ON item');
        $this->addSql('DROP INDEX IDX_1F1B251EF1FAD9D3 ON item');
        $this->addSql('ALTER TABLE item DROP user_id, DROP bundle_id');
    }
}
