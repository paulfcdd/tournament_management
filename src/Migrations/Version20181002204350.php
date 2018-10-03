<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181002204350 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE countries ADD association_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE countries ADD CONSTRAINT FK_5D66EBADEFB9C8A5 FOREIGN KEY (association_id) REFERENCES associations (id)');
        $this->addSql('CREATE INDEX IDX_5D66EBADEFB9C8A5 ON countries (association_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE countries DROP FOREIGN KEY FK_5D66EBADEFB9C8A5');
        $this->addSql('DROP INDEX IDX_5D66EBADEFB9C8A5 ON countries');
        $this->addSql('ALTER TABLE countries DROP association_id');
    }
}
