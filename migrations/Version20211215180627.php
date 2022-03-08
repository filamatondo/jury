<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211215180627 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE apropo DROP FOREIGN KEY FK_FB377CA6763C10B2');
        $this->addSql('ALTER TABLE apropo CHANGE videos_id videos_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE apropo ADD CONSTRAINT FK_FB377CA6763C10B2 FOREIGN KEY (videos_id) REFERENCES user (id) ON DELETE SET NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE apropo DROP FOREIGN KEY FK_FB377CA6763C10B2');
        $this->addSql('ALTER TABLE apropo CHANGE videos_id videos_id INT NOT NULL');
        $this->addSql('ALTER TABLE apropo ADD CONSTRAINT FK_FB377CA6763C10B2 FOREIGN KEY (videos_id) REFERENCES user (id)');
    }
}
