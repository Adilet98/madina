<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200425080950 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql('CREATE TABLE cabinet (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE schedule ADD teacher_id INT NOT NULL, ADD subject_id INT NOT NULL, ADD class_group_id INT NOT NULL, ADD cabinet_id INT NOT NULL, ADD day INT NOT NULL, ADD lesson_time INT NOT NULL');
        $this->addSql('ALTER TABLE schedule ADD CONSTRAINT FK_5A3811FB41807E1D FOREIGN KEY (teacher_id) REFERENCES teacher (id)');
        $this->addSql('ALTER TABLE schedule ADD CONSTRAINT FK_5A3811FB23EDC87 FOREIGN KEY (subject_id) REFERENCES subject (id)');
        $this->addSql('ALTER TABLE schedule ADD CONSTRAINT FK_5A3811FB4A9A1217 FOREIGN KEY (class_group_id) REFERENCES class_group (id)');
        $this->addSql('ALTER TABLE schedule ADD CONSTRAINT FK_5A3811FBD351EC FOREIGN KEY (cabinet_id) REFERENCES cabinet (id)');
        $this->addSql('CREATE INDEX IDX_5A3811FB41807E1D ON schedule (teacher_id)');
        $this->addSql('CREATE INDEX IDX_5A3811FB23EDC87 ON schedule (subject_id)');
        $this->addSql('CREATE INDEX IDX_5A3811FB4A9A1217 ON schedule (class_group_id)');
        $this->addSql('CREATE INDEX IDX_5A3811FBD351EC ON schedule (cabinet_id)');
    }

    public function down(Schema $schema) : void
    {
        $this->addSql('ALTER TABLE schedule DROP FOREIGN KEY FK_5A3811FBD351EC');
        $this->addSql('DROP TABLE cabinet');
        $this->addSql('ALTER TABLE schedule DROP FOREIGN KEY FK_5A3811FB41807E1D');
        $this->addSql('ALTER TABLE schedule DROP FOREIGN KEY FK_5A3811FB23EDC87');
        $this->addSql('ALTER TABLE schedule DROP FOREIGN KEY FK_5A3811FB4A9A1217');
        $this->addSql('DROP INDEX IDX_5A3811FB41807E1D ON schedule');
        $this->addSql('DROP INDEX IDX_5A3811FB23EDC87 ON schedule');
        $this->addSql('DROP INDEX IDX_5A3811FB4A9A1217 ON schedule');
        $this->addSql('DROP INDEX IDX_5A3811FBD351EC ON schedule');
        $this->addSql('ALTER TABLE schedule DROP teacher_id, DROP subject_id, DROP class_group_id, DROP cabinet_id, DROP day, DROP lesson_time');
    }
}
