<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190730120149 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE critique ADD film_id INT NOT NULL');
        $this->addSql('ALTER TABLE critique ADD CONSTRAINT FK_1F950324567F5183 FOREIGN KEY (film_id) REFERENCES films (id)');
        $this->addSql('CREATE INDEX IDX_1F950324567F5183 ON critique (film_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE critique DROP FOREIGN KEY FK_1F950324567F5183');
        $this->addSql('DROP INDEX IDX_1F950324567F5183 ON critique');
        $this->addSql('ALTER TABLE critique DROP film_id');
    }
}
