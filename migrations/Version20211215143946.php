<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211215143946 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE apropo (id INT AUTO_INCREMENT NOT NULL, videos_id INT NOT NULL, paragraphe VARCHAR(255) NOT NULL, text VARCHAR(255) NOT NULL, biographie VARCHAR(255) NOT NULL, INDEX IDX_FB377CA6763C10B2 (videos_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE apropo ADD CONSTRAINT FK_FB377CA6763C10B2 FOREIGN KEY (videos_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE apropo');
    }
}
