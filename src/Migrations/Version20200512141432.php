<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200512141432 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE plat_prepare (id INT AUTO_INCREMENT NOT NULL, nom_plat VARCHAR(155) NOT NULL, nbre_plat INT NOT NULL, date_prepare DATETIME NOT NULL, prix_total DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE plat_prepare_detail_lot_recu (plat_prepare_id INT NOT NULL, detail_lot_recu_id INT NOT NULL, INDEX IDX_E546D650E1F53381 (plat_prepare_id), INDEX IDX_E546D650675AEAF6 (detail_lot_recu_id), PRIMARY KEY(plat_prepare_id, detail_lot_recu_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE plat_prepare_detail_lot_recu ADD CONSTRAINT FK_E546D650E1F53381 FOREIGN KEY (plat_prepare_id) REFERENCES plat_prepare (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE plat_prepare_detail_lot_recu ADD CONSTRAINT FK_E546D650675AEAF6 FOREIGN KEY (detail_lot_recu_id) REFERENCES detail_lot_recu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recherche_recette_nom CHANGE nom_recette nom_recette VARCHAR(155) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE plat_prepare_detail_lot_recu DROP FOREIGN KEY FK_E546D650E1F53381');
        $this->addSql('DROP TABLE plat_prepare');
        $this->addSql('DROP TABLE plat_prepare_detail_lot_recu');
        $this->addSql('ALTER TABLE recherche_recette_nom CHANGE nom_recette nom_recette VARCHAR(155) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
    }
}
