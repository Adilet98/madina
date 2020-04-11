<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200411172057 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF33ED766068');
        $this->addSql('DROP INDEX UNIQ_B723AF33ED766068 ON student');
        $this->addSql('ALTER TABLE student CHANGE username_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF33A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B723AF33A76ED395 ON student (user_id)');
        $this->addSql('ALTER TABLE teacher DROP FOREIGN KEY FK_B0F6A6D5ED766068');
        $this->addSql('DROP INDEX UNIQ_B0F6A6D5ED766068 ON teacher');
        $this->addSql('ALTER TABLE teacher CHANGE username_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE teacher ADD CONSTRAINT FK_B0F6A6D5A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B0F6A6D5A76ED395 ON teacher (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF33A76ED395');
        $this->addSql('DROP INDEX UNIQ_B723AF33A76ED395 ON student');
        $this->addSql('ALTER TABLE student CHANGE user_id username_id INT NOT NULL');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF33ED766068 FOREIGN KEY (username_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B723AF33ED766068 ON student (username_id)');
        $this->addSql('ALTER TABLE teacher DROP FOREIGN KEY FK_B0F6A6D5A76ED395');
        $this->addSql('DROP INDEX UNIQ_B0F6A6D5A76ED395 ON teacher');
        $this->addSql('ALTER TABLE teacher CHANGE user_id username_id INT NOT NULL');
        $this->addSql('ALTER TABLE teacher ADD CONSTRAINT FK_B0F6A6D5ED766068 FOREIGN KEY (username_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B0F6A6D5ED766068 ON teacher (username_id)');
    }
}
