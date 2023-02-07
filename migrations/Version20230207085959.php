<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230207085959 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE film_show (id INT AUTO_INCREMENT NOT NULL, room_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, INDEX IDX_57A1330254177093 (room_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE film_show_taken_seat (id INT AUTO_INCREMENT NOT NULL, film_show_id INT DEFAULT NULL, line INT NOT NULL, seat INT NOT NULL, reservation_number CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', UNIQUE INDEX UNIQ_8345C464DE6156CF (reservation_number), INDEX IDX_8345C464307FE747 (film_show_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE room (id INT AUTO_INCREMENT NOT NULL, row_count INT NOT NULL, row_seat_count INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE film_show ADD CONSTRAINT FK_57A1330254177093 FOREIGN KEY (room_id) REFERENCES room (id)');
        $this->addSql('ALTER TABLE film_show_taken_seat ADD CONSTRAINT FK_8345C464307FE747 FOREIGN KEY (film_show_id) REFERENCES film_show (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE film_show DROP FOREIGN KEY FK_57A1330254177093');
        $this->addSql('ALTER TABLE film_show_taken_seat DROP FOREIGN KEY FK_8345C464307FE747');
        $this->addSql('DROP TABLE film_show');
        $this->addSql('DROP TABLE film_show_taken_seat');
        $this->addSql('DROP TABLE room');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
