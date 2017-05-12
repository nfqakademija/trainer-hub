<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170512233148 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE city (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE training_time (id INT AUTO_INCREMENT NOT NULL, training_id INT DEFAULT NULL, date DATETIME NOT NULL, number INT NOT NULL, INDEX IDX_600EDF06BEFD98D1 (training_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservations (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, training_id INT DEFAULT NULL, status VARCHAR(255) DEFAULT \'0\' NOT NULL, INDEX IDX_4DA23919EB6921 (client_id), INDEX IDX_4DA239BEFD98D1 (training_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fos_user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, username_canonical VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, email_canonical VARCHAR(180) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, confirmation_token VARCHAR(180) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', name VARCHAR(255) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, phone VARCHAR(255) DEFAULT NULL, description VARCHAR(5000) DEFAULT NULL, avatar_name VARCHAR(255) DEFAULT NULL, avatar_size INT DEFAULT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_957A647992FC23A8 (username_canonical), UNIQUE INDEX UNIQ_957A6479A0D96FBF (email_canonical), UNIQUE INDEX UNIQ_957A6479C05FB297 (confirmation_token), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE feedback (id INT AUTO_INCREMENT NOT NULL, author_id INT DEFAULT NULL, object_id INT DEFAULT NULL, feedback VARCHAR(2500) NOT NULL, created_at DATETIME DEFAULT NULL, rating INT NOT NULL, INDEX IDX_D2294458F675F31B (author_id), INDEX IDX_D2294458232D562B (object_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE training (id INT AUTO_INCREMENT NOT NULL, trainer_id INT DEFAULT NULL, category_id INT DEFAULT NULL, city_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, price NUMERIC(10, 0) NOT NULL, description VARCHAR(5000) NOT NULL, INDEX IDX_D5128A8FFB08EDF6 (trainer_id), INDEX IDX_D5128A8F12469DE2 (category_id), INDEX IDX_D5128A8F8BAC62AF (city_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE training_time ADD CONSTRAINT FK_600EDF06BEFD98D1 FOREIGN KEY (training_id) REFERENCES training (id)');
        $this->addSql('ALTER TABLE reservations ADD CONSTRAINT FK_4DA23919EB6921 FOREIGN KEY (client_id) REFERENCES fos_user (id)');
        $this->addSql('ALTER TABLE reservations ADD CONSTRAINT FK_4DA239BEFD98D1 FOREIGN KEY (training_id) REFERENCES training_time (id)');
        $this->addSql('ALTER TABLE feedback ADD CONSTRAINT FK_D2294458F675F31B FOREIGN KEY (author_id) REFERENCES fos_user (id)');
        $this->addSql('ALTER TABLE feedback ADD CONSTRAINT FK_D2294458232D562B FOREIGN KEY (object_id) REFERENCES fos_user (id)');
        $this->addSql('ALTER TABLE training ADD CONSTRAINT FK_D5128A8FFB08EDF6 FOREIGN KEY (trainer_id) REFERENCES fos_user (id)');
        $this->addSql('ALTER TABLE training ADD CONSTRAINT FK_D5128A8F12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE training ADD CONSTRAINT FK_D5128A8F8BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE training DROP FOREIGN KEY FK_D5128A8F8BAC62AF');
        $this->addSql('ALTER TABLE reservations DROP FOREIGN KEY FK_4DA239BEFD98D1');
        $this->addSql('ALTER TABLE training DROP FOREIGN KEY FK_D5128A8F12469DE2');
        $this->addSql('ALTER TABLE reservations DROP FOREIGN KEY FK_4DA23919EB6921');
        $this->addSql('ALTER TABLE feedback DROP FOREIGN KEY FK_D2294458F675F31B');
        $this->addSql('ALTER TABLE feedback DROP FOREIGN KEY FK_D2294458232D562B');
        $this->addSql('ALTER TABLE training DROP FOREIGN KEY FK_D5128A8FFB08EDF6');
        $this->addSql('ALTER TABLE training_time DROP FOREIGN KEY FK_600EDF06BEFD98D1');
        $this->addSql('DROP TABLE city');
        $this->addSql('DROP TABLE training_time');
        $this->addSql('DROP TABLE reservations');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE fos_user');
        $this->addSql('DROP TABLE feedback');
        $this->addSql('DROP TABLE training');
    }
}
