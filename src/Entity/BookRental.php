<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BookRentalRepository")
 */
class BookRental
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Users")
     * @ORM\JoinColumn(nullable=false)
     */
    private $userID;

    /**
     * @ORM\Column(type="datetime")
     */
    private $rentalDateOut;

    /**
     * @ORM\Column(type="datetime")
     */
    private $rentalDateReturn;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $rentalDetails;

    /**
     * @ORM\Column(type="integer")
     */
    private $rentalAmountDue;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Adresses")
     */
    private $addressID;

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

    public function getUserID(): ?Users
    {
        return $this->userID;
    }

    public function setUserID(?Users $userID): self
    {
        $this->userID = $userID;

        return $this;
    }

    public function getRentalDateOut(): ?\DateTimeInterface
    {
        return $this->rentalDateOut;
    }

    public function setRentalDateOut(\DateTimeInterface $rentalDateOut): self
    {
        $this->rentalDateOut = $rentalDateOut;

        return $this;
    }

    public function getRentalDateReturn(): ?\DateTimeInterface
    {
        return $this->rentalDateReturn;
    }

    public function setRentalDateReturn(\DateTimeInterface $rentalDateReturn): self
    {
        $this->rentalDateReturn = $rentalDateReturn;

        return $this;
    }

    public function getRentalDetails(): ?string
    {
        return $this->rentalDetails;
    }

    public function setRentalDetails(?string $rentalDetails): self
    {
        $this->rentalDetails = $rentalDetails;

        return $this;
    }

    public function getRentalAmountDue(): ?int
    {
        return $this->rentalAmountDue;
    }

    public function setRentalAmountDue(int $rentalAmountDue): self
    {
        $this->rentalAmountDue = $rentalAmountDue;

        return $this;
    }

    public function getAddressID(): ?Adresses
    {
        return $this->addressID;
    }

    public function setAddressID(?Adresses $addressID): self
    {
        $this->addressID = $addressID;

        return $this;
    }
}
