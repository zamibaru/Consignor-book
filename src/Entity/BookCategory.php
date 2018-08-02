<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BookCategoryRepository")
 */
class BookCategory
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Books")
     * @ORM\JoinColumn(name="bookID", referencedColumnName="bookID", nullable=false)
     */
    private $bookID;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Categories")
     * @ORM\JoinColumn(name="categoryID", referencedColumnName="categoryID", nullable=false)
     */
    private $categoryID;

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

    public function getCategoryID(): ?Categories
    {
        return $this->categoryID;
    }

    public function setCategoryID(?Categories $categoryID): self
    {
        $this->categoryID = $categoryID;

        return $this;
    }
}
