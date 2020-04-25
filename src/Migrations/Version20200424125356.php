<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200424125356 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql('ALTER TABLE student ADD quarter_one INT DEFAULT NULL, ADD quarter_two INT DEFAULT NULL, ADD quarter_three INT DEFAULT NULL, ADD quarter_four INT DEFAULT NULL, ADD year INT DEFAULT NULL, ADD exam INT DEFAULT NULL, ADD final INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        $this->addSql('ALTER TABLE student DROP quarter_one, DROP quarter_two, DROP quarter_three, DROP quarter_four, DROP year, DROP exam, DROP final');
    }
}
