<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241204195425 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE mensaje (id INT AUTO_INCREMENT NOT NULL, usuario_id INT DEFAULT NULL, remitente_id INT DEFAULT NULL, destinatario_id INT DEFAULT NULL, asunto VARCHAR(255) NOT NULL, fecha DATE NOT NULL, cuerpo LONGTEXT NOT NULL, INDEX IDX_9B631D01DB38439E (usuario_id), INDEX IDX_9B631D011C3E945F (remitente_id), INDEX IDX_9B631D01B564FBC1 (destinatario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE usuario (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, fullname VARCHAR(255) NOT NULL, provincia VARCHAR(255) NOT NULL, administrador TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_USERNAME (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE mensaje ADD CONSTRAINT FK_9B631D01DB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE mensaje ADD CONSTRAINT FK_9B631D011C3E945F FOREIGN KEY (remitente_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE mensaje ADD CONSTRAINT FK_9B631D01B564FBC1 FOREIGN KEY (destinatario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE mensajes DROP FOREIGN KEY mensajes_ibfk_2');
        $this->addSql('ALTER TABLE mensajes DROP FOREIGN KEY mensajes_ibfk_1');
        $this->addSql('DROP TABLE mensajes');
        $this->addSql('DROP TABLE usuarios');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE mensajes (id INT AUTO_INCREMENT NOT NULL, remitente VARCHAR(20) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, destinatario VARCHAR(20) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, asunto VARCHAR(60) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, cuerpo TEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, INDEX remitente (remitente), INDEX destinatario (destinatario), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE usuarios (login VARCHAR(20) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, password VARCHAR(32) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, nombre VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, PRIMARY KEY(login)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE mensajes ADD CONSTRAINT mensajes_ibfk_2 FOREIGN KEY (destinatario) REFERENCES usuarios (login)');
        $this->addSql('ALTER TABLE mensajes ADD CONSTRAINT mensajes_ibfk_1 FOREIGN KEY (remitente) REFERENCES usuarios (login)');
        $this->addSql('ALTER TABLE mensaje DROP FOREIGN KEY FK_9B631D01DB38439E');
        $this->addSql('ALTER TABLE mensaje DROP FOREIGN KEY FK_9B631D011C3E945F');
        $this->addSql('ALTER TABLE mensaje DROP FOREIGN KEY FK_9B631D01B564FBC1');
        $this->addSql('DROP TABLE mensaje');
        $this->addSql('DROP TABLE usuario');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
