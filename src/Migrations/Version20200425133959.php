<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200425133959 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql('CREATE TABLE teacher_class_group (teacher_id INT NOT NULL, class_group_id INT NOT NULL, INDEX IDX_5D4BD9B941807E1D (teacher_id), INDEX IDX_5D4BD9B94A9A1217 (class_group_id), PRIMARY KEY(teacher_id, class_group_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE teacher_class_group ADD CONSTRAINT FK_5D4BD9B941807E1D FOREIGN KEY (teacher_id) REFERENCES teacher (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE teacher_class_group ADD CONSTRAINT FK_5D4BD9B94A9A1217 FOREIGN KEY (class_group_id) REFERENCES class_group (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        $this->addSql('DROP TABLE teacher_class_group');
    }
}
