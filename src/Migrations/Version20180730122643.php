<?php

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180730122643 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE adresses (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, street VARCHAR(255) NOT NULL, number VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, zipcode VARCHAR(40) NOT NULL, address_details VARCHAR(255) DEFAULT NULL, INDEX IDX_EF1925529D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE book_category (id INT AUTO_INCREMENT NOT NULL, bookID VARCHAR(13) NOT NULL, categoryID INT NOT NULL, INDEX IDX_1FB30F9898515D3F (bookID), INDEX IDX_1FB30F98A7592BB9 (categoryID), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE book_rental (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, address_id_id INT DEFAULT NULL, rental_date_out DATETIME NOT NULL, rental_date_return DATETIME NOT NULL, rental_details VARCHAR(255) DEFAULT NULL, rental_amount_due INT NOT NULL, bookID VARCHAR(13) NOT NULL, INDEX IDX_3FCEC9F098515D3F (bookID), INDEX IDX_3FCEC9F09D86650F (user_id_id), INDEX IDX_3FCEC9F048E1E977 (address_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, category_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, user_name VARCHAR(255) NOT NULL, user_email VARCHAR(255) NOT NULL, user_password VARCHAR(255) NOT NULL, user_roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json_array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE adresses ADD CONSTRAINT FK_EF1925529D86650F FOREIGN KEY (user_id_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE book_category ADD CONSTRAINT FK_1FB30F9898515D3F FOREIGN KEY (bookID) REFERENCES books (bookID)');
        $this->addSql('ALTER TABLE book_category ADD CONSTRAINT FK_1FB30F98A7592BB9 FOREIGN KEY (categoryID) REFERENCES categories (categoryID)');
        $this->addSql('ALTER TABLE book_rental ADD CONSTRAINT FK_3FCEC9F098515D3F FOREIGN KEY (bookID) REFERENCES books (bookID)');
        $this->addSql('ALTER TABLE book_rental ADD CONSTRAINT FK_3FCEC9F09D86650F FOREIGN KEY (user_id_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE book_rental ADD CONSTRAINT FK_3FCEC9F048E1E977 FOREIGN KEY (address_id_id) REFERENCES adresses (id)');
        $this->addSql('ALTER TABLE books_author ADD CONSTRAINT FK_796560C498515D3F FOREIGN KEY (bookID) REFERENCES books (bookID)');
        $this->addSql('ALTER TABLE books_author ADD CONSTRAINT FK_796560C4A196F9FD FOREIGN KEY (authorId) REFERENCES authors (authorId)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE book_rental DROP FOREIGN KEY FK_3FCEC9F048E1E977');
        $this->addSql('ALTER TABLE book_category DROP FOREIGN KEY FK_1FB30F98A7592BB9');
        $this->addSql('ALTER TABLE adresses DROP FOREIGN KEY FK_EF1925529D86650F');
        $this->addSql('ALTER TABLE book_rental DROP FOREIGN KEY FK_3FCEC9F09D86650F');
        $this->addSql('DROP TABLE adresses');
        $this->addSql('DROP TABLE book_category');
        $this->addSql('DROP TABLE book_rental');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE users');
        $this->addSql('ALTER TABLE books_author DROP FOREIGN KEY FK_796560C498515D3F');
        $this->addSql('ALTER TABLE books_author DROP FOREIGN KEY FK_796560C4A196F9FD');
    }
}
