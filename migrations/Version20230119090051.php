<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230119090051 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE film_show DROP FOREIGN KEY FK_57A1330235F83FFC');
        $this->addSql('DROP INDEX IDX_57A1330235F83FFC ON film_show');
        $this->addSql('ALTER TABLE film_show CHANGE room_id_id room_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE film_show ADD CONSTRAINT FK_57A1330254177093 FOREIGN KEY (room_id) REFERENCES room (id)');
        $this->addSql('CREATE INDEX IDX_57A1330254177093 ON film_show (room_id)');
        $this->addSql('ALTER TABLE film_show_taken_seat DROP FOREIGN KEY FK_8345C464C21157C3');
        $this->addSql('DROP INDEX IDX_8345C464C21157C3 ON film_show_taken_seat');
        $this->addSql('ALTER TABLE film_show_taken_seat ADD film_show_id INT DEFAULT NULL, DROP film_show_id_id');
        $this->addSql('ALTER TABLE film_show_taken_seat ADD CONSTRAINT FK_8345C464307FE747 FOREIGN KEY (film_show_id) REFERENCES film_show (id)');
        $this->addSql('CREATE INDEX IDX_8345C464307FE747 ON film_show_taken_seat (film_show_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE film_show DROP FOREIGN KEY FK_57A1330254177093');
        $this->addSql('DROP INDEX IDX_57A1330254177093 ON film_show');
        $this->addSql('ALTER TABLE film_show CHANGE room_id room_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE film_show ADD CONSTRAINT FK_57A1330235F83FFC FOREIGN KEY (room_id_id) REFERENCES room (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_57A1330235F83FFC ON film_show (room_id_id)');
        $this->addSql('ALTER TABLE film_show_taken_seat DROP FOREIGN KEY FK_8345C464307FE747');
        $this->addSql('DROP INDEX IDX_8345C464307FE747 ON film_show_taken_seat');
        $this->addSql('ALTER TABLE film_show_taken_seat ADD film_show_id_id INT NOT NULL, DROP film_show_id');
        $this->addSql('ALTER TABLE film_show_taken_seat ADD CONSTRAINT FK_8345C464C21157C3 FOREIGN KEY (film_show_id_id) REFERENCES film_show (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_8345C464C21157C3 ON film_show_taken_seat (film_show_id_id)');
    }
}
