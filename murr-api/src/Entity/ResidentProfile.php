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
    const PROV_INITIALS = ['NL','PE','NS','NS','QC','ON','MB','SK','AB','BC','YT','NT','NU'];
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
     * @Assert\Length(max="50", maxMessage="Street address must not exceed 50 characters.")
     */
    private $streetAddress;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     * @Assert\Length(max="30", maxMessage="City must not exceed 30 characters.")
     */
    private $city;

    /**
     * @Assert\Choice(choices=ResidentProfile::PROV_INITIALS, message="Province Initials must be one of these choices: ['NL','PE','NS','NB','QC','ON','MB','SK','AB','BC','YT','NT','NU'].")
     * @ORM\Column(type="string", length=2, nullable=true)
     * @Assert\Length(max="2", maxMessage="Province Initials must not exceed 2 characters.")
     */
    private $province;

    /**
     * @ORM\Column(type="string", length=7, nullable=true)
     * @Assert\Length (max="7", maxMessage="Postal code must not exceed 7 characters.")
     * @Assert\Regex(
     *     pattern ="/^[A-Za-z]\d[A-Za-z][ ]?\d[A-Za-z]\d$/",
     *     match=true,
     *     message="Postal code must follow the format 'L#L#L#'.")
     *
     */
    private $postalCode;

    /**
     * @ORM\OneToOne (targetEntity="Resident", inversedBy="residentProfile")
     * @ORM\JoinColumn(name="residentID", referencedColumnName="id")
    */
    private $resident;

    /**
     * @return mixed
     */
    public function getResident()
    {
        return $this->resident;
    }

    /**
     * @param mixed $resident
     */
    public function setResident($resident): void
    {
        $this->resident = $resident;
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
