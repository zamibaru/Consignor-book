<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AuthorsRepository")
 */
class Authors
{
    
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     */
    private $authorId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $authorFirstName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $authorLastName;

     /**
     * One Author can have Many Books.
     * @ORM\ManyToMany(targetEntity="App\Entity\Books", mappedBy="authorId")
     * @ORM\JoinTable(name="BooksAuthor",
     *              joinColumns={@ORM\JoinColumn(name="authorId", referencedColumnName="authorId")},
     *              inverseJoinColumns={@ORM\JoinColumn(name="bookID", referencedColumnName="bookID", unique=true)}
     *      )
     */
    private $arrBooks;

    public function __construct()
    {
        $this->arrBooks = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthorId(): ?int
    {
        return $this->authorId;
    }

    public function setAuthorId(int $authorId): self
    {
        $this->authorId = $authorId;

        return $this;
    }

    public function getAuthorFirstName(): ?string
    {
        return $this->authorFirstName;
    }

    public function setAuthorFirstName(string $authorFirstName): self
    {
        $this->authorFirstName = $authorFirstName;

        return $this;
    }

    public function getAuthorLastName(): ?string
    {
        return $this->authorLastName;
    }

    public function setAuthorLastName(string $authorLastName): self
    {
        $this->authorLastName = $authorLastName;

        return $this;
    }

    /**
     * @return Collection|BooksAuthor[]
     */
    public function getBooks(): Collection
    {
        return $this->arrBooks;
    }

    public function addBooks(BooksAuthor $bookId): self
    {
        if (!$this->bookIarrBooksd->contains($bookId)) {
            $this->arrBooks[] = $bookId;
            $bookId->setAuthorId($this);
        }

        return $this;
    }

    public function removeBooks(BooksAuthor $bookId): self
    {
        if ($this->arrBooks->contains($bookId)) {
            $this->arrBooks->removeElement($bookId);
            // set the owning side to null (unless already changed)
            if ($bookId->getAuthorId() === $this) {
                $bookId->setAuthorId(null);
            }
        }

        return $this;
    }
}
