<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221107124918 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE individuelclient ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE individuelclient ADD CONSTRAINT FK_9B96C69FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_9B96C69FA76ED395 ON individuelclient (user_id)');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64914C27CDF');
        $this->addSql('DROP INDEX IDX_8D93D64914C27CDF ON user');
        $this->addSql('ALTER TABLE user DROP individuelclient_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE individuelclient DROP FOREIGN KEY FK_9B96C69FA76ED395');
        $this->addSql('DROP INDEX IDX_9B96C69FA76ED395 ON individuelclient');
        $this->addSql('ALTER TABLE individuelclient DROP user_id');
        $this->addSql('ALTER TABLE user ADD individuelclient_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64914C27CDF FOREIGN KEY (individuelclient_id) REFERENCES individuelclient (id)');
        $this->addSql('CREATE INDEX IDX_8D93D64914C27CDF ON user (individuelclient_id)');
    }
}
