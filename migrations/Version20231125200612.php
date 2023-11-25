<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231125200612 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE courses ADD lang_id INT NOT NULL, CHANGE created_at created_at DATETIME NOT NULL, CHANGE is_free is_free TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE courses ADD CONSTRAINT FK_A9A55A4CB213FA4 FOREIGN KEY (lang_id) REFERENCES languages (id)');
        $this->addSql('CREATE INDEX IDX_A9A55A4CB213FA4 ON courses (lang_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE courses DROP FOREIGN KEY FK_A9A55A4CB213FA4');
        $this->addSql('DROP INDEX IDX_A9A55A4CB213FA4 ON courses');
        $this->addSql('ALTER TABLE courses DROP lang_id, CHANGE created_at created_at VARCHAR(255) NOT NULL, CHANGE is_free is_free DATETIME NOT NULL');
    }
}
