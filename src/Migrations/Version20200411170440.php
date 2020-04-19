<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200411170440 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql('ALTER TABLE student ADD username_id INT NOT NULL, DROP username');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF33ED766068 FOREIGN KEY (username_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B723AF33ED766068 ON student (username_id)');
        $this->addSql('ALTER TABLE teacher ADD username_id INT NOT NULL');
        $this->addSql('ALTER TABLE teacher ADD CONSTRAINT FK_B0F6A6D5ED766068 FOREIGN KEY (username_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B0F6A6D5ED766068 ON teacher (username_id)');
    }

    public function down(Schema $schema) : void
    {
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF33ED766068');
        $this->addSql('DROP INDEX UNIQ_B723AF33ED766068 ON student');
        $this->addSql('ALTER TABLE student ADD username VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP username_id');
        $this->addSql('ALTER TABLE teacher DROP FOREIGN KEY FK_B0F6A6D5ED766068');
        $this->addSql('DROP INDEX UNIQ_B0F6A6D5ED766068 ON teacher');
        $this->addSql('ALTER TABLE teacher DROP username_id');
    }
}
