<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ResidentProfileRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=ResidentProfileRepository::class)
 */
class ResidentProfile
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     * @Assert\Length(max="20", maxMessage="First name must not exceed 20 characters.")
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     * @Assert\Length(max="20", maxMessage="Last name must not exceed 20 characters.")
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     * @Assert\Length(max="250", maxMessage="Street address must not exceed 50 characters.")
     */
    private $streetAddress;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     * @Assert\Length(max="30", maxMessage="City must not exceed 30 characters.")
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=2, nullable=true)
     * @Assert\Length(max="2", maxMessage="Province Initials must not exceed 2 characters.")
     */
    private $province;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Assert\Regex(
     *     pattern ="/^[A-Za-z]\d[A-Za-z][ -]?\d[A-Za-z]\d$/",
     *     match=true,
     *     message="Postal code must follow the format 'L#L#L#'")
     */
    private $postalCode;

    /**
     * @ORM\OneToOne (targetEntity="Resident", inversedBy="residentProfile")
     * @ORM\JoinColumn(name="residentID", referencedColumnName="id")
    */
    private $resident;

    public function _construct()
    {
        $this->resident = new ArrayCollection();
    }

    /**
     * @return Collection
     */
    public function getResident(): Collection
    {
        return $this->resident;
    }

    public function addResident(Resident $resident):self
    {
        if(!$this->resident->contains($resident)) {
            $this->resident[] = $resident;
        }
        return $this;
    }

    public function removeResident(Resident $resident):self
    {
        $this->resident->removeElement($resident);
        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getStreetAddress(): ?string
    {
        return $this->streetAddress;
    }

    public function setStreetAddress(?string $streetAddress): self
    {
        $this->streetAddress = $streetAddress;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getProvince(): ?string
    {
        return $this->province;
    }

    public function setProvince(?string $province): self
    {
        $this->province = $province;

        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function setPostalCode(?string $postalCode): self
    {
        $this->postalCode = $postalCode;

        return $this;
    }
}
