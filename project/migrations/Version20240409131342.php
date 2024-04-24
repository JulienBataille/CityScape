<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240409131342 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE amenities (id INT AUTO_INCREMENT NOT NULL, property_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_EB705477549213EC (property_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE detailsinformation (id INT AUTO_INCREMENT NOT NULL, area_size NUMERIC(10, 2) DEFAULT NULL, size_prefix VARCHAR(255) DEFAULT NULL, land_area VARCHAR(255) DEFAULT NULL, bedroom INT DEFAULT NULL, bathrooms INT DEFAULT NULL, garages INT DEFAULT NULL, year_build DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gallery (id INT AUTO_INCREMENT NOT NULL, property_id INT DEFAULT NULL, image_name VARCHAR(255) DEFAULT NULL, image_size INT DEFAULT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT CURRENT_TIMESTAMP COMMENT \'(DC2Type:datetime_immutable)\', deleted_at DATETIME DEFAULT CURRENT_TIMESTAMP COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_472B783A549213EC (property_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE property (id INT AUTO_INCREMENT NOT NULL, statuts_id INT NOT NULL, agent_immo_id INT DEFAULT NULL, details_information_id INT DEFAULT NULL, lang VARCHAR(255) NOT NULL, property_title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, price NUMERIC(10, 0) DEFAULT NULL, area NUMERIC(10, 3) NOT NULL, INDEX IDX_8BF21CDEE0EA5904 (statuts_id), INDEX IDX_8BF21CDE7E9CE0ED (agent_immo_id), UNIQUE INDEX UNIQ_8BF21CDE4FD3518D (details_information_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE amenities ADD CONSTRAINT FK_EB705477549213EC FOREIGN KEY (property_id) REFERENCES property (id)');
        $this->addSql('ALTER TABLE gallery ADD CONSTRAINT FK_472B783A549213EC FOREIGN KEY (property_id) REFERENCES property (id)');
        $this->addSql('ALTER TABLE property ADD CONSTRAINT FK_8BF21CDEE0EA5904 FOREIGN KEY (statuts_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE property ADD CONSTRAINT FK_8BF21CDE7E9CE0ED FOREIGN KEY (agent_immo_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE property ADD CONSTRAINT FK_8BF21CDE4FD3518D FOREIGN KEY (details_information_id) REFERENCES detailsinformation (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE amenities DROP FOREIGN KEY FK_EB705477549213EC');
        $this->addSql('ALTER TABLE gallery DROP FOREIGN KEY FK_472B783A549213EC');
        $this->addSql('ALTER TABLE property DROP FOREIGN KEY FK_8BF21CDEE0EA5904');
        $this->addSql('ALTER TABLE property DROP FOREIGN KEY FK_8BF21CDE7E9CE0ED');
        $this->addSql('ALTER TABLE property DROP FOREIGN KEY FK_8BF21CDE4FD3518D');
        $this->addSql('DROP TABLE amenities');
        $this->addSql('DROP TABLE detailsinformation');
        $this->addSql('DROP TABLE gallery');
        $this->addSql('DROP TABLE property');
    }
}
