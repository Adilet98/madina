<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200415114527 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE class_group ADD name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE student ADD group_name_id INT NOT NULL');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF33F717C8DA FOREIGN KEY (group_name_id) REFERENCES class_group (id)');
        $this->addSql('CREATE INDEX IDX_B723AF33F717C8DA ON student (group_name_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE class_group DROP name');
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF33F717C8DA');
        $this->addSql('DROP INDEX IDX_B723AF33F717C8DA ON student');
        $this->addSql('ALTER TABLE student DROP group_name_id');
    }
}
