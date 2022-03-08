<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220121063506 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE liste_ami_ajouter (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE liste_ami_ajouter_user (liste_ami_ajouter_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_B7A4042D3467C706 (liste_ami_ajouter_id), INDEX IDX_B7A4042DA76ED395 (user_id), PRIMARY KEY(liste_ami_ajouter_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE liste_ami_ajouter_user ADD CONSTRAINT FK_B7A4042D3467C706 FOREIGN KEY (liste_ami_ajouter_id) REFERENCES liste_ami_ajouter (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE liste_ami_ajouter_user ADD CONSTRAINT FK_B7A4042DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mention CHANGE articl articl MEDIUMTEXT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE liste_ami_ajouter_user DROP FOREIGN KEY FK_B7A4042D3467C706');
        $this->addSql('DROP TABLE liste_ami_ajouter');
        $this->addSql('DROP TABLE liste_ami_ajouter_user');
        $this->addSql('ALTER TABLE mention CHANGE articl articl MEDIUMTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
