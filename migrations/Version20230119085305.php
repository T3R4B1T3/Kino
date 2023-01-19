<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230119085305 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE film_show_taken_seat ADD film_show_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE film_show_taken_seat ADD CONSTRAINT FK_8345C464C21157C3 FOREIGN KEY (film_show_id_id) REFERENCES film_show (id)');
        $this->addSql('CREATE INDEX IDX_8345C464C21157C3 ON film_show_taken_seat (film_show_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE film_show_taken_seat DROP FOREIGN KEY FK_8345C464C21157C3');
        $this->addSql('DROP INDEX IDX_8345C464C21157C3 ON film_show_taken_seat');
        $this->addSql('ALTER TABLE film_show_taken_seat DROP film_show_id_id');
    }
}
