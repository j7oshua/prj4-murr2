<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\ResidentRepository")
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
     * @ORM\Column(type="string", length=150)
     * @Assert\Email(message = "The email is not a valid email.")
     * @Assert\Length(max = 150, maxMessage = "Email has more than {{ limit }} characters.")
     * @Assert\NotBlank(message="not blank")
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=10)
     * @Assert\Length(min = 10, max = 10, exactMessage = "Phone needs to be {{ limit }} digits.")
     * @Assert\NotBlank(message="not blank")
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\Length(max = 50, maxMessage = "Password has more than {{ limit }} characters.")
     * @Assert\NotBlank(message = "Password should not be left blank.")
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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }
}
