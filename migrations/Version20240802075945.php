<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240802075945 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE question (id INT AUTO_INCREMENT NOT NULL, question_text VARCHAR(255) NOT NULL, choices JSON NOT NULL, correct_answer VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE score (id INT AUTO_INCREMENT NOT NULL, player_name VARCHAR(255) NOT NULL, score INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql("
            INSERT INTO question (question_text, choices, correct_answer) VALUES
            ('Quelle est la capitale de la France ?', '[\"Paris\", \"Lyon\", \"Marseille\", \"Nice\"]', 'Paris'),
            ('Combien de continents y a-t-il sur Terre ?', '[\"5\", \"6\", \"7\", \"8\"]', '7'),
            ('Quel est le plus grand océan du monde ?', '[\"Océan Atlantique\", \"Océan Pacifique\", \"Océan Indien\", \"Océan Arctique\"]', 'Océan Pacifique'),
            ('Quel est le plus petit pays du monde ?', '[\"Monaco\", \"Nauru\", \"Vatican\", \"Malte\"]', 'Vatican'),
            ('Quel est l\\'élément chimique avec le symbole H ?', '[\"Hélium\", \"Hydrogène\", \"Hafnium\", \"Hassium\"]', 'Hydrogène'),
            ('En quelle année l\\'homme a-t-il marché sur la Lune pour la première fois ?', '[\"1965\", \"1969\", \"1972\", \"1980\"]', '1969'),
            ('Quel est le plus haut sommet du monde ?', '[\"Mont Everest\", \"K2\", \"Kangchenjunga\", \"Lhotse\"]', 'Mont Everest'),
            ('Quel est le plus grand désert du monde ?', '[\"Désert du Sahara\", \"Désert de Gobi\", \"Désert d\\'Atacama\", \"Antarctique\"]', 'Antarctique'),
            ('Quel est le plus long fleuve du monde ?', '[\"Nil\", \"Amazone\", \"Yangtsé\", \"Mississippi\"]', 'Amazone'),
            ('Quelle est la planète la plus proche du soleil ?', '[\"Mercure\", \"Vénus\", \"Terre\", \"Mars\"]', 'Mercure')
        ");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE question');
        $this->addSql('DROP TABLE score');
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('DELETE FROM question');
    }
}
