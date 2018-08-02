<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BooksRepository")
 */
class Books
{

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $bookTitle;

    /**
     * @ORM\Column(type="string")
     */
    private $bookCover;

    /**
     * @ORM\Id()
     * @ORM\Column(type="string", length=13)
     */
    private $bookID;

     /**
     * @ORM\Column(type="text")
     */
    private $bookDescription;

     /**
     * @ORM\Column(type="integer")
     */
    private $bookType;

    /**
     * One Book can have Many Authors.
     * @ORM\ManyToMany(targetEntity="Authors")
     * @ORM\JoinTable(name="books_author",
     *          joinColumns={@ORM\JoinColumn(name="book_id", referencedColumnName="book_id")},
     *          inverseJoinColumns={@ORM\JoinColumn(name="author_id", referencedColumnName="author_id", unique=true)}
     *      )
     */
    private $arrAuthor;

    protected $arrAuthors;

    public function __construct()
    {
        $this->arrAuthor = new ArrayCollection();
    }


    public function getBookTitle(): ?string
    {
        return $this->bookTitle;
    }

    public function setBookTitle(string $bookTitle): self
    {
        $this->bookTitle = $bookTitle;

        return $this;
    }

    public function getBookCover(): ?string
    {
        return $this->bookCover;
    }

    public function setBookCover(string $bookCover): self
    {
        $this->bookCover = $bookCover;

        return $this;
    }

    public function getBookID(): ?string
    {
        return $this->bookID;
    }

    public function setBookID(string $bookID): self
    {
        $this->bookID = $bookID;

        return $this;
    }

    public function getBookDescription(): ?string
    {
        return $this->bookDescription;
    }

    public function setBookDescription(string $bookDescription): self
    {
        $this->bookDescription = $bookDescription;

        return $this;
    }

    public function getBookType()
    {
        return $this->bookType;
    }

    public function setBookType(string $bookType): self
    {
        $this->bookType = $bookType;

        return $this;
    }

    /**
     * @return Collection|BooksAuthor[]
     */
    public function getArrAuthor(): Collection
    {
        return $this->arrAuthor;
    }

    public function addArrAuthor(BooksAuthor $authorId): self
    {
        if (!$this->arrAuthor->contains($authorId)) {
            $this->arrAuthor[] = $authorId;
            $authorId->setBookID($this);
        }

        return $this;
    }

    public function removeArrAuthor(BooksAuthor $authorId): self
    {
        if ($this->arrAuthor->contains($authorId)) {
            $this->arrAuthor->removeElement($authorId);
            // set the owning side to null (unless already changed)
            if ($authorId->getBookID() === $this) {
                $authorId->setBookID(null);
            }
        }

        return $this;
    }

}
