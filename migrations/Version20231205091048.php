<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231205091048 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE course_tag DROP FOREIGN KEY FK_FFDF2695591CC992');
        $this->addSql('ALTER TABLE course_tag DROP FOREIGN KEY FK_FFDF2695BAD26311');
        $this->addSql('DROP TABLE course_tag');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE course_tag (tag_id INT NOT NULL, course_id INT NOT NULL, INDEX IDX_FFDF2695591CC992 (course_id), INDEX IDX_FFDF2695BAD26311 (tag_id), PRIMARY KEY(tag_id, course_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE course_tag ADD CONSTRAINT FK_FFDF2695591CC992 FOREIGN KEY (course_id) REFERENCES course (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE course_tag ADD CONSTRAINT FK_FFDF2695BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON UPDATE NO ACTION ON DELETE CASCADE');
    }
}
