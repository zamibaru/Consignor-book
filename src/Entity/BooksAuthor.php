<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BooksAuthorRepository")
 */
class BooksAuthor
{

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Books", inversedBy="authorId")
     */
    private $bookID;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Authors", inversedBy="bookId")
     */
    private $authorId;

    public function getId()
    {
        return $this->id;
    }

    public function getBookID(): ?Books
    {
        return $this->bookID;
    }

    public function setBookID(?Books $bookID): self
    {
        $this->bookID = $bookID;

        return $this;
    }

    public function getAuthorId(): ?Authors
    {
        return $this->authorId;
    }

    public function setAuthorId(?Authors $authorId): self
    {
        $this->authorId = $authorId;

        return $this;
    }
}
