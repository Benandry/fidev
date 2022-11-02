<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221102072205 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE transfert (id INT AUTO_INCREMENT NOT NULL, compteenvoyeur_id INT DEFAULT NULL, comptedestinataire_id INT DEFAULT NULL, montant VARCHAR(255) NOT NULL, typetransfert VARCHAR(255) NOT NULL, INDEX IDX_1E4EACBBECCA8840 (compteenvoyeur_id), INDEX IDX_1E4EACBBB8E8C492 (comptedestinataire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE transfert ADD CONSTRAINT FK_1E4EACBBECCA8840 FOREIGN KEY (compteenvoyeur_id) REFERENCES compte_epargne (id)');
        $this->addSql('ALTER TABLE transfert ADD CONSTRAINT FK_1E4EACBBB8E8C492 FOREIGN KEY (comptedestinataire_id) REFERENCES compte_epargne (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE transfert');
    }
}
