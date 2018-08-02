<?php

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180730102915 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE books_author ADD PRIMARY KEY (bookID, authorId)');
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

        $this->addSql('ALTER TABLE books_author DROP FOREIGN KEY FK_796560C498515D3F');
        $this->addSql('ALTER TABLE books_author DROP FOREIGN KEY FK_796560C4A196F9FD');
        $this->addSql('ALTER TABLE books_author DROP PRIMARY KEY');
    }
}
