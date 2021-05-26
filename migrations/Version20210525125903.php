<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210525125903 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE liste (id INT AUTO_INCREMENT NOT NULL, id_user_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_FCF22AF479F37AE5 (id_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE liste_vocabulaire (liste_id INT NOT NULL, vocabulaire_id INT NOT NULL, INDEX IDX_C2640291E85441D8 (liste_id), INDEX IDX_C2640291D8B12F03 (vocabulaire_id), PRIMARY KEY(liste_id, vocabulaire_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE liste_kanji (liste_id INT NOT NULL, kanji_id INT NOT NULL, INDEX IDX_5D944972E85441D8 (liste_id), INDEX IDX_5D944972FB3081B8 (kanji_id), PRIMARY KEY(liste_id, kanji_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, pseudo VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE liste ADD CONSTRAINT FK_FCF22AF479F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE liste_vocabulaire ADD CONSTRAINT FK_C2640291E85441D8 FOREIGN KEY (liste_id) REFERENCES liste (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE liste_vocabulaire ADD CONSTRAINT FK_C2640291D8B12F03 FOREIGN KEY (vocabulaire_id) REFERENCES vocabulaire (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE liste_kanji ADD CONSTRAINT FK_5D944972E85441D8 FOREIGN KEY (liste_id) REFERENCES liste (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE liste_kanji ADD CONSTRAINT FK_5D944972FB3081B8 FOREIGN KEY (kanji_id) REFERENCES kanji (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE liste_vocabulaire DROP FOREIGN KEY FK_C2640291E85441D8');
        $this->addSql('ALTER TABLE liste_kanji DROP FOREIGN KEY FK_5D944972E85441D8');
        $this->addSql('ALTER TABLE liste DROP FOREIGN KEY FK_FCF22AF479F37AE5');
        $this->addSql('DROP TABLE liste');
        $this->addSql('DROP TABLE liste_vocabulaire');
        $this->addSql('DROP TABLE liste_kanji');
        $this->addSql('DROP TABLE user');
    }
}
