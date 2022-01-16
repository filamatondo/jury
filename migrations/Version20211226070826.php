<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211226070826 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mention DROP FOREIGN KEY FK_E20259CD5AB60E7E');
        $this->addSql('ALTER TABLE mention ADD articl MEDIUMTEXT NOT NULL, CHANGE mentions_id mentions_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE mention ADD CONSTRAINT FK_E20259CD5AB60E7E FOREIGN KEY (mentions_id) REFERENCES user (id) ON DELETE SET NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mention DROP FOREIGN KEY FK_E20259CD5AB60E7E');
        $this->addSql('ALTER TABLE mention DROP articl, CHANGE mentions_id mentions_id INT NOT NULL');
        $this->addSql('ALTER TABLE mention ADD CONSTRAINT FK_E20259CD5AB60E7E FOREIGN KEY (mentions_id) REFERENCES user (id)');
    }
}
