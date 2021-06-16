<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210615002400 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE intervention ADD materiel_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE intervention ADD CONSTRAINT FK_D11814AB16880AAF FOREIGN KEY (materiel_id) REFERENCES materiel (id)');
        $this->addSql('CREATE INDEX IDX_D11814AB16880AAF ON intervention (materiel_id)');
        $this->addSql('ALTER TABLE materiel ADD piecesderechange_id INT DEFAULT NULL, ADD inventaire_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE materiel ADD CONSTRAINT FK_18D2B091E5754769 FOREIGN KEY (piecesderechange_id) REFERENCES piecesderechange (id)');
        $this->addSql('ALTER TABLE materiel ADD CONSTRAINT FK_18D2B091CE430A85 FOREIGN KEY (inventaire_id) REFERENCES inventaire (id)');
        $this->addSql('CREATE INDEX IDX_18D2B091E5754769 ON materiel (piecesderechange_id)');
        $this->addSql('CREATE INDEX IDX_18D2B091CE430A85 ON materiel (inventaire_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE intervention DROP FOREIGN KEY FK_D11814AB16880AAF');
        $this->addSql('DROP INDEX IDX_D11814AB16880AAF ON intervention');
        $this->addSql('ALTER TABLE intervention DROP materiel_id');
        $this->addSql('ALTER TABLE materiel DROP FOREIGN KEY FK_18D2B091E5754769');
        $this->addSql('ALTER TABLE materiel DROP FOREIGN KEY FK_18D2B091CE430A85');
        $this->addSql('DROP INDEX IDX_18D2B091E5754769 ON materiel');
        $this->addSql('DROP INDEX IDX_18D2B091CE430A85 ON materiel');
        $this->addSql('ALTER TABLE materiel DROP piecesderechange_id, DROP inventaire_id');
    }
}
