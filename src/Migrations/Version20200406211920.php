<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200406211920 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE detail_lot_recu CHANGE type_aliment type_aliment_id INT NOT NULL');
        $this->addSql('ALTER TABLE detail_lot_recu ADD CONSTRAINT FK_A223748C5C584934 FOREIGN KEY (type_aliment_id) REFERENCES type_aliment (id)');
        $this->addSql('CREATE INDEX IDX_A223748C5C584934 ON detail_lot_recu (type_aliment_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE detail_lot_recu DROP FOREIGN KEY FK_A223748C5C584934');
        $this->addSql('DROP INDEX IDX_A223748C5C584934 ON detail_lot_recu');
        $this->addSql('ALTER TABLE detail_lot_recu CHANGE type_aliment_id type_aliment INT NOT NULL');
    }
}
