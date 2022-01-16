<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211021005138 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE agenda DROP FOREIGN KEY FK_2CEDC8775582E9C0');
        $this->addSql('ALTER TABLE agenda CHANGE bloc_id bloc_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE agenda ADD CONSTRAINT FK_2CEDC8775582E9C0 FOREIGN KEY (bloc_id) REFERENCES user (id) ON DELETE SET NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE agenda DROP FOREIGN KEY FK_2CEDC8775582E9C0');
        $this->addSql('ALTER TABLE agenda CHANGE bloc_id bloc_id INT NOT NULL');
        $this->addSql('ALTER TABLE agenda ADD CONSTRAINT FK_2CEDC8775582E9C0 FOREIGN KEY (bloc_id) REFERENCES user (id)');
    }
}
