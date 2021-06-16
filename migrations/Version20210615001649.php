<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210615001649 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bondecommande (id INT AUTO_INCREMENT NOT NULL, num VARCHAR(255) NOT NULL, nmbmt VARCHAR(255) NOT NULL, prix VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE intervention (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, date VARCHAR(255) NOT NULL, nmbpr VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inventaire (id INT AUTO_INCREMENT NOT NULL, unite_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_338920E0EC4A74AB (unite_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE materiel (id INT AUTO_INCREMENT NOT NULL, intervention_id INT DEFAULT NULL, inventaire_id INT DEFAULT NULL, type VARCHAR(255) NOT NULL, datedacquisition VARCHAR(255) NOT NULL, affectation VARCHAR(255) NOT NULL, etat VARCHAR(255) NOT NULL, INDEX IDX_18D2B0918EAE3863 (intervention_id), UNIQUE INDEX UNIQ_18D2B091CE430A85 (inventaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE piecesderechange (id INT AUTO_INCREMENT NOT NULL, materiel_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_6371183316880AAF (materiel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE unite (id INT AUTO_INCREMENT NOT NULL, materiel_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, emplacement VARCHAR(255) NOT NULL, INDEX IDX_1D64C11816880AAF (materiel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE inventaire ADD CONSTRAINT FK_338920E0EC4A74AB FOREIGN KEY (unite_id) REFERENCES unite (id)');
        $this->addSql('ALTER TABLE materiel ADD CONSTRAINT FK_18D2B0918EAE3863 FOREIGN KEY (intervention_id) REFERENCES intervention (id)');
        $this->addSql('ALTER TABLE materiel ADD CONSTRAINT FK_18D2B091CE430A85 FOREIGN KEY (inventaire_id) REFERENCES inventaire (id)');
        $this->addSql('ALTER TABLE piecesderechange ADD CONSTRAINT FK_6371183316880AAF FOREIGN KEY (materiel_id) REFERENCES materiel (id)');
        $this->addSql('ALTER TABLE unite ADD CONSTRAINT FK_1D64C11816880AAF FOREIGN KEY (materiel_id) REFERENCES materiel (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE materiel DROP FOREIGN KEY FK_18D2B0918EAE3863');
        $this->addSql('ALTER TABLE materiel DROP FOREIGN KEY FK_18D2B091CE430A85');
        $this->addSql('ALTER TABLE piecesderechange DROP FOREIGN KEY FK_6371183316880AAF');
        $this->addSql('ALTER TABLE unite DROP FOREIGN KEY FK_1D64C11816880AAF');
        $this->addSql('ALTER TABLE inventaire DROP FOREIGN KEY FK_338920E0EC4A74AB');
        $this->addSql('DROP TABLE bondecommande');
        $this->addSql('DROP TABLE intervention');
        $this->addSql('DROP TABLE inventaire');
        $this->addSql('DROP TABLE materiel');
        $this->addSql('DROP TABLE piecesderechange');
        $this->addSql('DROP TABLE unite');
    }
}
