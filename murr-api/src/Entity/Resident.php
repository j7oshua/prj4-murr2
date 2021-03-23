<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ResidentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Validator as AcmeAssert;

/**
 * @ApiResource(
 *     itemOperations={"get"={
 *             "path"="/resident/{id}",
 *             "swagger_context"={
 *                 "tags"={"Resident"}
 *             }
 *          }
 *     },
 *     collectionOperations={
 *         "post"={
 *             "path"="/resident/1",
 *             "method"="POST",
 *             "swagger_context"={
 *                 "tags"={"Authentication"},
 *                 "summary"={"User registration"}
 *             }
 *         },
 *         "get"={
 *             "path"="/resident/{id}",
 *             "method"="GET",
 *             "swagger_context"={
 *                 "tags"={"Resident"}
 *             }
 *          }
 *     },
 * )
 * @ORM\Entity(repositoryClass="App\Repository\ResidentRepository")
 * @AcmeAssert\PhoneAndEmailBothLeftBlank
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Entity(repositoryClass=ResidentRepository::class)
 */
class Resident
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Assert\PositiveOrZero(message = "The ID has to be zero or a positive number")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=150, nullable=true)
     * @Assert\Email(message = "The email is not a valid email.")
     * @Assert\Length(allowEmptyString="true", max = 150, maxMessage = "Email has more than {{ limit }} characters.")
     *
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     * @Assert\Length(allowEmptyString="true", min=10, max = 10, exactMessage = "Phone needs to be {{ limit }} digits.")
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=30)
     * @Assert\Length(allowEmptyString="false", min=7, max = 30, minMessage="Password has to be at least {{ limit }} characters.", maxMessage = "Password has to be {{ limit }} characters or less.")
     * @Assert\NotBlank(message = "Password should not be left blank.")
     */
    private $password;

    /**
     * @ORM\ManyToMany(targetEntity=Point::class, mappedBy="resident")
     */
    private $points;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @ORM\Column(type="string", unique=true, nullable=true)
     */
    private $apiToken;

    public function __construct()
    {
        $this->points = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * @return Collection|Point[]
     */
    public function getPoints(): Collection
    {
        return $this->points;
    }

    public function addPoint(Point $point): self
    {
        if (!$this->points->contains($point)) {
            $this->points[] = $point;
            $point->addResident($this);
        }
        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function removePoint(Point $point): self
    {
        if ($this->points->removeElement($point)) {
            $point->removeResident($this);
        }
        return $this;
    }

    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getApiToken(): ?string
    {
        return $this->apiToken;
    }

    public function setApiToken(?string $apiToken): void
    {
        $this->apiToken = $apiToken ?? md5(uniqid(rand(), true));
    }

    /**
     * @ORM\PrePersist
     */
    public function createToken(): void
    {
        if(!$this->apiToken) {
            $this->apiToken = md5(uniqid(rand(), true));
        }
    }
}
