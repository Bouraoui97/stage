<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210615002015 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE materiel DROP FOREIGN KEY FK_18D2B0918EAE3863');
        $this->addSql('ALTER TABLE materiel DROP FOREIGN KEY FK_18D2B091CE430A85');
        $this->addSql('DROP INDEX UNIQ_18D2B091CE430A85 ON materiel');
        $this->addSql('DROP INDEX IDX_18D2B0918EAE3863 ON materiel');
        $this->addSql('ALTER TABLE materiel DROP intervention_id, DROP inventaire_id');
        $this->addSql('ALTER TABLE piecesderechange DROP FOREIGN KEY FK_6371183316880AAF');
        $this->addSql('DROP INDEX IDX_6371183316880AAF ON piecesderechange');
        $this->addSql('ALTER TABLE piecesderechange DROP materiel_id');
        $this->addSql('ALTER TABLE unite DROP FOREIGN KEY FK_1D64C11816880AAF');
        $this->addSql('DROP INDEX IDX_1D64C11816880AAF ON unite');
        $this->addSql('ALTER TABLE unite DROP materiel_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE materiel ADD intervention_id INT DEFAULT NULL, ADD inventaire_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE materiel ADD CONSTRAINT FK_18D2B0918EAE3863 FOREIGN KEY (intervention_id) REFERENCES intervention (id)');
        $this->addSql('ALTER TABLE materiel ADD CONSTRAINT FK_18D2B091CE430A85 FOREIGN KEY (inventaire_id) REFERENCES inventaire (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_18D2B091CE430A85 ON materiel (inventaire_id)');
        $this->addSql('CREATE INDEX IDX_18D2B0918EAE3863 ON materiel (intervention_id)');
        $this->addSql('ALTER TABLE piecesderechange ADD materiel_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE piecesderechange ADD CONSTRAINT FK_6371183316880AAF FOREIGN KEY (materiel_id) REFERENCES materiel (id)');
        $this->addSql('CREATE INDEX IDX_6371183316880AAF ON piecesderechange (materiel_id)');
        $this->addSql('ALTER TABLE unite ADD materiel_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE unite ADD CONSTRAINT FK_1D64C11816880AAF FOREIGN KEY (materiel_id) REFERENCES materiel (id)');
        $this->addSql('CREATE INDEX IDX_1D64C11816880AAF ON unite (materiel_id)');
    }
}
