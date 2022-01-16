<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220109201729 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commentaire_video (id INT AUTO_INCREMENT NOT NULL, auteur_id INT DEFAULT NULL, videoes_id INT DEFAULT NULL, contenu VARCHAR(500) NOT NULL, date DATETIME NOT NULL, INDEX IDX_F94B123060BB6FE6 (auteur_id), INDEX IDX_F94B12302DC831B7 (videoes_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commentaire_video ADD CONSTRAINT FK_F94B123060BB6FE6 FOREIGN KEY (auteur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE commentaire_video ADD CONSTRAINT FK_F94B12302DC831B7 FOREIGN KEY (videoes_id) REFERENCES videos (id)');
        $this->addSql('ALTER TABLE mention CHANGE articl articl MEDIUMTEXT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE commentaire_video');
        $this->addSql('ALTER TABLE mention CHANGE articl articl MEDIUMTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
