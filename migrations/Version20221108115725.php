<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221108115725 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE individuelclient DROP FOREIGN KEY FK_9B96C69F804EC166');
        $this->addSql('DROP INDEX IDX_9B96C69F804EC166 ON individuelclient');
        $this->addSql('ALTER TABLE individuelclient ADD commune VARCHAR(255) NOT NULL, DROP idadresse_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE individuelclient ADD idadresse_id INT DEFAULT NULL, DROP commune');
        $this->addSql('ALTER TABLE individuelclient ADD CONSTRAINT FK_9B96C69F804EC166 FOREIGN KEY (idadresse_id) REFERENCES commune (id)');
        $this->addSql('CREATE INDEX IDX_9B96C69F804EC166 ON individuelclient (idadresse_id)');
    }
}
