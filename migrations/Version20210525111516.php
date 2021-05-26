<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210525111516 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE compteur (id INT AUTO_INCREMENT NOT NULL, symbole VARCHAR(255) NOT NULL, sens VARCHAR(255) NOT NULL, tableau LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE grammaire (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, jlpt VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE kanji (id INT AUTO_INCREMENT NOT NULL, caractere VARCHAR(255) NOT NULL, cle VARCHAR(255) DEFAULT NULL, kunyomi VARCHAR(255) DEFAULT NULL, onyomi VARCHAR(255) DEFAULT NULL, stroke INT NOT NULL, sens VARCHAR(255) NOT NULL, niveau VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE kanji_composant (kanji_id INT NOT NULL, composant_id INT NOT NULL, INDEX IDX_5B03B3DFB3081B8 (kanji_id), INDEX IDX_5B03B3D7F3310E7 (composant_id), PRIMARY KEY(kanji_id, composant_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vocabulaire (id INT AUTO_INCREMENT NOT NULL, mot VARCHAR(255) NOT NULL, kana VARCHAR(255) NOT NULL, romaji VARCHAR(255) NOT NULL, sens VARCHAR(255) NOT NULL, contexte LONGTEXT DEFAULT NULL, jlpt VARCHAR(255) DEFAULT NULL, accent VARCHAR(255) DEFAULT NULL, classe VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vocabulaire_kanji (vocabulaire_id INT NOT NULL, kanji_id INT NOT NULL, INDEX IDX_F756C34DD8B12F03 (vocabulaire_id), INDEX IDX_F756C34DFB3081B8 (kanji_id), PRIMARY KEY(vocabulaire_id, kanji_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vocabulaire_compteur (vocabulaire_id INT NOT NULL, compteur_id INT NOT NULL, INDEX IDX_CAEE3175D8B12F03 (vocabulaire_id), INDEX IDX_CAEE3175AA3B9810 (compteur_id), PRIMARY KEY(vocabulaire_id, compteur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vocabulaire_synonyme (vocabulaire_id INT NOT NULL, synonyme_id INT NOT NULL, INDEX IDX_FD2F2B26D8B12F03 (vocabulaire_id), INDEX IDX_FD2F2B26988F0033 (synonyme_id), PRIMARY KEY(vocabulaire_id, synonyme_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vocabulaire_antonyme (vocabulaire_id INT NOT NULL, antonyme_id INT NOT NULL, INDEX IDX_C3859ECDD8B12F03 (vocabulaire_id), INDEX IDX_C3859ECD92892F47 (antonyme_id), PRIMARY KEY(vocabulaire_id, antonyme_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE kanji_composant ADD CONSTRAINT FK_5B03B3DFB3081B8 FOREIGN KEY (kanji_id) REFERENCES kanji (id)');
        $this->addSql('ALTER TABLE kanji_composant ADD CONSTRAINT FK_5B03B3D7F3310E7 FOREIGN KEY (composant_id) REFERENCES kanji (id)');
        $this->addSql('ALTER TABLE vocabulaire_kanji ADD CONSTRAINT FK_F756C34DD8B12F03 FOREIGN KEY (vocabulaire_id) REFERENCES vocabulaire (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vocabulaire_kanji ADD CONSTRAINT FK_F756C34DFB3081B8 FOREIGN KEY (kanji_id) REFERENCES kanji (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vocabulaire_compteur ADD CONSTRAINT FK_CAEE3175D8B12F03 FOREIGN KEY (vocabulaire_id) REFERENCES vocabulaire (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vocabulaire_compteur ADD CONSTRAINT FK_CAEE3175AA3B9810 FOREIGN KEY (compteur_id) REFERENCES compteur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vocabulaire_synonyme ADD CONSTRAINT FK_FD2F2B26D8B12F03 FOREIGN KEY (vocabulaire_id) REFERENCES vocabulaire (id)');
        $this->addSql('ALTER TABLE vocabulaire_synonyme ADD CONSTRAINT FK_FD2F2B26988F0033 FOREIGN KEY (synonyme_id) REFERENCES vocabulaire (id)');
        $this->addSql('ALTER TABLE vocabulaire_antonyme ADD CONSTRAINT FK_C3859ECDD8B12F03 FOREIGN KEY (vocabulaire_id) REFERENCES vocabulaire (id)');
        $this->addSql('ALTER TABLE vocabulaire_antonyme ADD CONSTRAINT FK_C3859ECD92892F47 FOREIGN KEY (antonyme_id) REFERENCES vocabulaire (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vocabulaire_compteur DROP FOREIGN KEY FK_CAEE3175AA3B9810');
        $this->addSql('ALTER TABLE kanji_composant DROP FOREIGN KEY FK_5B03B3DFB3081B8');
        $this->addSql('ALTER TABLE kanji_composant DROP FOREIGN KEY FK_5B03B3D7F3310E7');
        $this->addSql('ALTER TABLE vocabulaire_kanji DROP FOREIGN KEY FK_F756C34DFB3081B8');
        $this->addSql('ALTER TABLE vocabulaire_kanji DROP FOREIGN KEY FK_F756C34DD8B12F03');
        $this->addSql('ALTER TABLE vocabulaire_compteur DROP FOREIGN KEY FK_CAEE3175D8B12F03');
        $this->addSql('ALTER TABLE vocabulaire_synonyme DROP FOREIGN KEY FK_FD2F2B26D8B12F03');
        $this->addSql('ALTER TABLE vocabulaire_synonyme DROP FOREIGN KEY FK_FD2F2B26988F0033');
        $this->addSql('ALTER TABLE vocabulaire_antonyme DROP FOREIGN KEY FK_C3859ECDD8B12F03');
        $this->addSql('ALTER TABLE vocabulaire_antonyme DROP FOREIGN KEY FK_C3859ECD92892F47');
        $this->addSql('DROP TABLE compteur');
        $this->addSql('DROP TABLE grammaire');
        $this->addSql('DROP TABLE kanji');
        $this->addSql('DROP TABLE kanji_composant');
        $this->addSql('DROP TABLE vocabulaire');
        $this->addSql('DROP TABLE vocabulaire_kanji');
        $this->addSql('DROP TABLE vocabulaire_compteur');
        $this->addSql('DROP TABLE vocabulaire_synonyme');
        $this->addSql('DROP TABLE vocabulaire_antonyme');
    }
}
