<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200404205439 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE type_recette (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(150) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE type_rectte');
        $this->addSql('ALTER TABLE recette ADD type_recette_id INT NOT NULL, DROP type_recette, CHANGE nom_recette nom_recette VARCHAR(100) NOT NULL, CHANGE duree duree VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE recette ADD CONSTRAINT FK_49BB63909432F9CC FOREIGN KEY (type_recette_id) REFERENCES type_recette (id)');
        $this->addSql('CREATE INDEX IDX_49BB63909432F9CC ON recette (type_recette_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE recette DROP FOREIGN KEY FK_49BB63909432F9CC');
        $this->addSql('CREATE TABLE type_rectte (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(150) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE type_recette');
        $this->addSql('DROP INDEX IDX_49BB63909432F9CC ON recette');
        $this->addSql('ALTER TABLE recette ADD type_recette VARCHAR(150) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP type_recette_id, CHANGE nom_recette nom_recette VARCHAR(150) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE duree duree VARCHAR(55) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
