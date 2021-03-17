<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ResidentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use App\Validator as AcmeAssert;

/**
 * @ApiResource(
 *     collectionOperations={"post", "get"},
 *     itemOperations={"get"}
 * )
 * @ORM\Entity(repositoryClass="App\Repository\ResidentRepository")
 * @AcmeAssert\PhoneAndEmailBothLeftBlank
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
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     * @Assert\Length(allowEmptyString="true", min=10, max = 10, exactMessage = "Phone needs to be {{ limit }} digits.", normalizer="trim")
     * @Assert\Regex(pattern="/^[0-9]/", message="Phone number must only contain numbers.")
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=30)
     * @Assert\Length(allowEmptyString="false", min=7, max = 30, minMessage="Password has to be at least {{ limit }} characters.", maxMessage = "Password has to be {{ limit }} characters or less.")
     * @Assert\NotBlank(message = "Password should not be left blank.")
     */
    private $password;

    /**
     * @ORM\ManyToMany(targetEntity=Point::class, mappedBy="resident", cascade={"merge"})
     */
    private $points;

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
}
