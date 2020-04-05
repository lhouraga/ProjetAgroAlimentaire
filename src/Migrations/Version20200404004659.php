<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200404004659 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE type_aliment (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE detail_aliment_recu CHANGE id_lot lot_id INT NOT NULL, CHANGE qte_disponible qte_dispo DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE detail_aliment_recu ADD CONSTRAINT FK_86D69310A8CBA5F7 FOREIGN KEY (lot_id) REFERENCES lot (id)');
        $this->addSql('CREATE INDEX IDX_86D69310A8CBA5F7 ON detail_aliment_recu (lot_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE type_aliment');
        $this->addSql('ALTER TABLE detail_aliment_recu DROP FOREIGN KEY FK_86D69310A8CBA5F7');
        $this->addSql('DROP INDEX IDX_86D69310A8CBA5F7 ON detail_aliment_recu');
        $this->addSql('ALTER TABLE detail_aliment_recu CHANGE lot_id id_lot INT NOT NULL, CHANGE qte_dispo qte_disponible DOUBLE PRECISION NOT NULL');
    }
}
