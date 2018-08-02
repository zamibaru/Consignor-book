<?php

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180730123151 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE books_author');
        $this->addSql('ALTER TABLE book_category ADD CONSTRAINT FK_1FB30F9898515D3F FOREIGN KEY (bookID) REFERENCES books (bookID)');
        $this->addSql('ALTER TABLE book_category ADD CONSTRAINT FK_1FB30F98A7592BB9 FOREIGN KEY (categoryID) REFERENCES categories (categoryID)');
        $this->addSql('ALTER TABLE book_rental ADD CONSTRAINT FK_3FCEC9F098515D3F FOREIGN KEY (bookID) REFERENCES books (bookID)');
        $this->addSql('ALTER TABLE book_rental ADD CONSTRAINT FK_3FCEC9F09D86650F FOREIGN KEY (user_id_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE book_rental ADD CONSTRAINT FK_3FCEC9F048E1E977 FOREIGN KEY (address_id_id) REFERENCES adresses (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE books_author (bookID VARCHAR(13) NOT NULL COLLATE utf8mb4_unicode_ci, authorId INT NOT NULL, INDEX IDX_796560C498515D3F (bookID), INDEX IDX_796560C4A196F9FD (authorId), PRIMARY KEY(bookID, authorId)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE book_category DROP FOREIGN KEY FK_1FB30F9898515D3F');
        $this->addSql('ALTER TABLE book_category DROP FOREIGN KEY FK_1FB30F98A7592BB9');
        $this->addSql('ALTER TABLE book_rental DROP FOREIGN KEY FK_3FCEC9F098515D3F');
        $this->addSql('ALTER TABLE book_rental DROP FOREIGN KEY FK_3FCEC9F09D86650F');
        $this->addSql('ALTER TABLE book_rental DROP FOREIGN KEY FK_3FCEC9F048E1E977');
    }
}
