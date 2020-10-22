<?php

namespace App\Entity;

use App\Repository\ResidentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ResidentRepository::class)
 */
class Resident
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $email;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $siteID;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=12)
     */
    private $phone;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $points;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $password;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getSiteID(): ?int
    {
        return $this->siteID;
    }

    public function setSiteID(?int $siteID): self
    {
        $this->siteID = $siteID;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getPoints(): ?int
    {
        return $this->points;
    }

    public function setPoints(?int $points): self
    {
        $this->points = $points;

        return $this;
    }


    public function setPassword($password): void
    {
        $this->password = $password;
    }


}