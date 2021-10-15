<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211012231755 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E6660BB6FE6');
        $this->addSql('ALTER TABLE article CHANGE auteur_id auteur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E6660BB6FE6 FOREIGN KEY (auteur_id) REFERENCES user (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC60BB6FE6');
        $this->addSql('ALTER TABLE commentaire CHANGE auteur_id auteur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC60BB6FE6 FOREIGN KEY (auteur_id) REFERENCES user (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE messages DROP FOREIGN KEY FK_DB021E96F624B39D');
        $this->addSql('ALTER TABLE messages CHANGE sender_id sender_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE messages ADD CONSTRAINT FK_DB021E96F624B39D FOREIGN KEY (sender_id) REFERENCES user (id) ON DELETE SET NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E6660BB6FE6');
        $this->addSql('ALTER TABLE article CHANGE auteur_id auteur_id INT NOT NULL');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E6660BB6FE6 FOREIGN KEY (auteur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC60BB6FE6');
        $this->addSql('ALTER TABLE commentaire CHANGE auteur_id auteur_id INT NOT NULL');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC60BB6FE6 FOREIGN KEY (auteur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE messages DROP FOREIGN KEY FK_DB021E96F624B39D');
        $this->addSql('ALTER TABLE messages CHANGE sender_id sender_id INT NOT NULL');
        $this->addSql('ALTER TABLE messages ADD CONSTRAINT FK_DB021E96F624B39D FOREIGN KEY (sender_id) REFERENCES user (id)');
    }
}
