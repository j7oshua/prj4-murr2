<?php


namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProfileRepository;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *     collectionOperations={"get", "put", "post"},
 *     itemOperations={"get", "put"}
 * )
 * @ORM\Entity(repositoryClass=ProfileRepository::class)
 */
class Profile
{

    /**
     * @ORM\Id
     * @ORM\OneToOne(targetEntity="Resident", mappedBy="id")
     * @ORM\Column(type="integer")
     * @Assert\PositiveOrZero
     */
    private $residentID;

    /**
     * @ORM\Column (type="string", length=20, nullable=true)
     * @Assert\Length(max="20", min="2", maxMessage="First Name cannot be longer than {{ limit }} characters.", minMessage="First Name must be more than 1 character")
     */
    private $firstName;

    /**
     * @ORM\Column (type="string", length=20, nullable=true)
     * @Assert\Length(max="20", maxMessage="Last Name cannot be longer than {{ limit }} characters.")
     */
    private $lastName;

    /**
     * @ORM\Column (type="string", nullable=true)
     * @Assert\Image(mimeTypes="image/*", mimeTypesMessage="This file is not a valid image.")
     */
    private $profilePic;

    /**
     * @return mixed
     */
    public function getResidentID()
    {
        return $this->residentID;
    }

    /**
     * @param mixed $residentID
     */
    public function setResidentID($residentID): void
    {
        $this->residentID = $residentID;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getProfilePic()
    {
        return $this->profilePic;
    }

    /**
     * @param mixed $profilePic
     */
    public function setProfilePic($profilePic): void
    {
        $this->profilePic = $profilePic;
    }

}