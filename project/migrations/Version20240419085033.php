<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240419085033 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE amenities DROP FOREIGN KEY FK_EB705477549213EC');
        $this->addSql('ALTER TABLE amenities ADD CONSTRAINT FK_EB705477549213EC FOREIGN KEY (property_id) REFERENCES property (id)');
        $this->addSql('ALTER TABLE cart DROP FOREIGN KEY FK_BA388B7A76ED395');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B7A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE cart_property DROP FOREIGN KEY FK_156D53B51AD5CDBF');
        $this->addSql('ALTER TABLE cart_property DROP FOREIGN KEY FK_156D53B5549213EC');
        $this->addSql('ALTER TABLE cart_property ADD CONSTRAINT FK_156D53B51AD5CDBF FOREIGN KEY (cart_id) REFERENCES cart (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cart_property ADD CONSTRAINT FK_156D53B5549213EC FOREIGN KEY (property_id) REFERENCES property (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE gallery DROP FOREIGN KEY FK_472B783A549213EC');
        $this->addSql('ALTER TABLE gallery CHANGE created_at created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE gallery ADD CONSTRAINT FK_472B783A549213EC FOREIGN KEY (property_id) REFERENCES property (id)');
        $this->addSql('ALTER TABLE property DROP FOREIGN KEY FK_8BF21CDE4FD3518D');
        $this->addSql('ALTER TABLE property DROP FOREIGN KEY FK_8BF21CDE7E9CE0ED');
        $this->addSql('ALTER TABLE property DROP FOREIGN KEY FK_8BF21CDEE0EA5904');
        $this->addSql('ALTER TABLE property ADD slug VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE property ADD CONSTRAINT FK_8BF21CDE4FD3518D FOREIGN KEY (details_information_id) REFERENCES detailsinformation (id)');
        $this->addSql('ALTER TABLE property ADD CONSTRAINT FK_8BF21CDE7E9CE0ED FOREIGN KEY (agent_immo_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE property ADD CONSTRAINT FK_8BF21CDEE0EA5904 FOREIGN KEY (statuts_id) REFERENCES category (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE amenities DROP FOREIGN KEY FK_EB705477549213EC');
        $this->addSql('ALTER TABLE amenities ADD CONSTRAINT FK_EB705477549213EC FOREIGN KEY (property_id) REFERENCES property (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cart DROP FOREIGN KEY FK_BA388B7A76ED395');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B7A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE gallery DROP FOREIGN KEY FK_472B783A549213EC');
        $this->addSql('ALTER TABLE gallery CHANGE created_at created_at DATETIME DEFAULT CURRENT_TIMESTAMP COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE gallery ADD CONSTRAINT FK_472B783A549213EC FOREIGN KEY (property_id) REFERENCES property (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cart_property DROP FOREIGN KEY FK_156D53B51AD5CDBF');
        $this->addSql('ALTER TABLE cart_property DROP FOREIGN KEY FK_156D53B5549213EC');
        $this->addSql('ALTER TABLE cart_property ADD CONSTRAINT FK_156D53B51AD5CDBF FOREIGN KEY (cart_id) REFERENCES cart (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cart_property ADD CONSTRAINT FK_156D53B5549213EC FOREIGN KEY (property_id) REFERENCES property (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE property DROP FOREIGN KEY FK_8BF21CDEE0EA5904');
        $this->addSql('ALTER TABLE property DROP FOREIGN KEY FK_8BF21CDE7E9CE0ED');
        $this->addSql('ALTER TABLE property DROP FOREIGN KEY FK_8BF21CDE4FD3518D');
        $this->addSql('ALTER TABLE property DROP slug');
        $this->addSql('ALTER TABLE property ADD CONSTRAINT FK_8BF21CDEE0EA5904 FOREIGN KEY (statuts_id) REFERENCES category (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE property ADD CONSTRAINT FK_8BF21CDE7E9CE0ED FOREIGN KEY (agent_immo_id) REFERENCES user (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE property ADD CONSTRAINT FK_8BF21CDE4FD3518D FOREIGN KEY (details_information_id) REFERENCES detailsinformation (id) ON UPDATE CASCADE ON DELETE CASCADE');
    }
}
