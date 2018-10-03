<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181003075254 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE component (id INT AUTO_INCREMENT NOT NULL, creative_id INT NOT NULL, name VARCHAR(255) NOT NULL, posx INT NOT NULL, posy INT NOT NULL, posz INT NOT NULL, width INT NOT NULL, high INT NOT NULL, INDEX IDX_49FEA1578E0ED468 (creative_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE creative (id INT AUTO_INCREMENT NOT NULL, state VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, component_id INT NOT NULL, url VARCHAR(2083) NOT NULL, format VARCHAR(255) NOT NULL, weight INT NOT NULL, INDEX IDX_C53D045FE2ABAFFF (component_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE text (id INT AUTO_INCREMENT NOT NULL, component_id INT NOT NULL, content VARCHAR(140) NOT NULL, INDEX IDX_3B8BA7C7E2ABAFFF (component_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE video (id INT AUTO_INCREMENT NOT NULL, component_id INT NOT NULL, url VARCHAR(2083) NOT NULL, format VARCHAR(255) NOT NULL, weight INT NOT NULL, INDEX IDX_7CC7DA2CE2ABAFFF (component_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE component ADD CONSTRAINT FK_49FEA1578E0ED468 FOREIGN KEY (creative_id) REFERENCES creative (id)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045FE2ABAFFF FOREIGN KEY (component_id) REFERENCES component (id)');
        $this->addSql('ALTER TABLE text ADD CONSTRAINT FK_3B8BA7C7E2ABAFFF FOREIGN KEY (component_id) REFERENCES component (id)');
        $this->addSql('ALTER TABLE video ADD CONSTRAINT FK_7CC7DA2CE2ABAFFF FOREIGN KEY (component_id) REFERENCES component (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045FE2ABAFFF');
        $this->addSql('ALTER TABLE text DROP FOREIGN KEY FK_3B8BA7C7E2ABAFFF');
        $this->addSql('ALTER TABLE video DROP FOREIGN KEY FK_7CC7DA2CE2ABAFFF');
        $this->addSql('ALTER TABLE component DROP FOREIGN KEY FK_49FEA1578E0ED468');
        $this->addSql('DROP TABLE component');
        $this->addSql('DROP TABLE creative');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE text');
        $this->addSql('DROP TABLE video');
    }
}
