<?php


namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProfileRepository;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *     itemOperations={"get", "put"},
 *
 * )
 * @ORM\Entity(repositoryClass=ProfileRepository::class)
 */
class Profile
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     * @Assert\PositiveOrZero
     * @Groups("profile")
     */
    private $id;



    /**
     * @ORM\Column (type="string", length=20, nullable=true)
     * @Assert\Length(max="20", min="2", maxMessage="First Name cannot be longer than {{ limit }} characters.", minMessage="First Name must be more than 1 character")
     * @Groups("profile")
     */
    private $firstName;

    /**
     * @ORM\Column (type="string", length=20, nullable=true)
     * @Assert\Length(max="20", maxMessage="Last Name cannot be longer than {{ limit }} characters.")
     * @Groups("profile")
     */
    private $lastName;

    /**
     * @ORM\Column (type="string", nullable=true)
     * @Assert\Image(mimeTypes="image/*", mimeTypesMessage="This file is not a valid image.")
     * @Groups("profile")
     */
    private $profilePic;

    /**
     * @ORM\OneToOne(targetEntity=Resident::class, inversedBy="profile", cascade={"persist", "remove"})
     * @Groups("profile")
     * @Assert\NotNull
     */
    private $resident;

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Resident
     */
    public function getResident(): Resident
    {
        return $this->resident;
    }

    /**
     * @param Resident $resident
     */
    public function setResident(Resident $resident): void
    {
        $this->resident = $resident;
    }


    /**
     * @return ?string
     */
    public function getFirstName() :?string
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName(?string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return ?string
     */
    public function getLastName() :?string
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName(?string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return ?string
     */
    public function getProfilePic() : ?string
    {
        return $this->profilePic;
    }

    /**
     * @param mixed $profilePic
     */
    public function setProfilePic(?string $profilePic): void
    {
        $this->profilePic = $profilePic;
    }

}