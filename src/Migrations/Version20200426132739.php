<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200426132739 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql('CREATE TABLE grade (id INT AUTO_INCREMENT NOT NULL, subject_id INT NOT NULL, student_id INT NOT NULL, quarter_one INT DEFAULT NULL, quarter_two INT DEFAULT NULL, quarter_three INT DEFAULT NULL, quarter_four INT DEFAULT NULL, year INT DEFAULT NULL, exam INT DEFAULT NULL, final INT DEFAULT NULL, INDEX IDX_595AAE3423EDC87 (subject_id), INDEX IDX_595AAE34CB944F1A (student_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE grade ADD CONSTRAINT FK_595AAE3423EDC87 FOREIGN KEY (subject_id) REFERENCES subject (id)');
        $this->addSql('ALTER TABLE grade ADD CONSTRAINT FK_595AAE34CB944F1A FOREIGN KEY (student_id) REFERENCES student (id)');
        $this->addSql('ALTER TABLE student DROP quarter_one, DROP quarter_two, DROP quarter_three, DROP quarter_four, DROP year, DROP exam, DROP final');
    }

    public function down(Schema $schema) : void
    {
        $this->addSql('DROP TABLE grade');
        $this->addSql('ALTER TABLE student ADD quarter_one INT DEFAULT NULL, ADD quarter_two INT DEFAULT NULL, ADD quarter_three INT DEFAULT NULL, ADD quarter_four INT DEFAULT NULL, ADD year INT DEFAULT NULL, ADD exam INT DEFAULT NULL, ADD final INT DEFAULT NULL');
    }
}
