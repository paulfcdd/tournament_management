<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181003103503 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE associations (id INT AUTO_INCREMENT NOT NULL, continent INT NOT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8921C4B15E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE countries (id INT AUTO_INCREMENT NOT NULL, association_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_5D66EBAD5E237E06 (name), INDEX IDX_5D66EBADEFB9C8A5 (association_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE leagues (id INT AUTO_INCREMENT NOT NULL, country_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, league_ranking INT NOT NULL, number_of_clubs INT NOT NULL, UNIQUE INDEX UNIQ_85CE39E5E237E06 (name), INDEX IDX_85CE39EF92F3E70 (country_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE countries ADD CONSTRAINT FK_5D66EBADEFB9C8A5 FOREIGN KEY (association_id) REFERENCES associations (id)');
        $this->addSql('ALTER TABLE leagues ADD CONSTRAINT FK_85CE39EF92F3E70 FOREIGN KEY (country_id) REFERENCES countries (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE countries DROP FOREIGN KEY FK_5D66EBADEFB9C8A5');
        $this->addSql('ALTER TABLE leagues DROP FOREIGN KEY FK_85CE39EF92F3E70');
        $this->addSql('DROP TABLE associations');
        $this->addSql('DROP TABLE countries');
        $this->addSql('DROP TABLE leagues');
    }
}
