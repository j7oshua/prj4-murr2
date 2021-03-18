<?php


namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ArticleRepository;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *     collectionOperations={"get", "post", "put"},
 *     itemOperations={"get", "post", "put"}
 * )
 * @ORM\Entity(repositoryClass="App\Repository\AccountRepository")
 * @ORM\Entity(repositoryClass=AccountRepository::class)
 */
class Account
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Assert\PositiveOrZero(message="The ID has to be zero or a positive number.")
     */
    private $id;

    /**
     * @ORM\Column (type="string", length=20)
     * @Assert\Length(max="20", maxMessage="First Name cannot be longer than {{ limit }} characters.")
     * @Assert\NotBlank (message="First name cannot be blank")
     */
    private $firstName;

    /**
     * @ORM\Column (type="string", length=20)
     * @Assert\Length(max="20", maxMessage="Last Name cannot be longer than {{ limit }} characters.")
     */
    private $lastName;

    /**
     * @ORM\Column (type="string")
     */
    private $profilePic;

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

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
}