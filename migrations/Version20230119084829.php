<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230119084829 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE film_show ADD room_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE film_show ADD CONSTRAINT FK_57A1330235F83FFC FOREIGN KEY (room_id_id) REFERENCES room (id)');
        $this->addSql('CREATE INDEX IDX_57A1330235F83FFC ON film_show (room_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE film_show DROP FOREIGN KEY FK_57A1330235F83FFC');
        $this->addSql('DROP INDEX IDX_57A1330235F83FFC ON film_show');
        $this->addSql('ALTER TABLE film_show DROP room_id_id');
    }
}
