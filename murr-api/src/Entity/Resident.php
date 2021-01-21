<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Validator as AcmeAssert;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\ResidentRepository")
 * @AcmeAssert\PhoneAndEmailBothLeftBlank
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
     * @ORM\Column(type="string", length=150, nullable=true)
     * @Assert\Email(message = "The email is not a valid email.")
     * @Assert\Length(max = 150, maxMessage = "Email has more than {{ limit }} characters.")
     *
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     * @Assert\Length(min=10, max = 10, exactMessage = "Phone needs to be {{ limit }} digits.")
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=30)
     * @Assert\Length(min=7, max = 30, minMessage="Password has to have more than {{ limit }} characters.", maxMessage = "Password has more than {{ limit }} characters.")
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
