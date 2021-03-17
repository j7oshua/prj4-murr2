<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\PickUpRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Validator as AcmeAssert;

/**
 * @ApiResource(
 *     collectionOperations={"post", "get"},
 *     itemOperations={"get"}
 * )
 * @ORM\Entity(repositoryClass=PickUpRepository::class)point_resident
 */
class PickUp
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Assert\PositiveOrZero(message="ID must be a positive number")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotNull(message="Invalid: Bin input required.")
     * @Assert\PositiveOrZero(message="number of bins must be a zero or positve integer")
     */
    private $numCollected;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotNull(message="Invalid: Bin input required.")
     * @Assert\PositiveOrZero(message="number of bins must be a zero or positve integer")
     */
    private $numObstructed;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotNull(message="Invalid: Bin input required.")
     * @Assert\PositiveOrZero (message="number of bins must be a zero or positve integer")
     */
    private $numContaminated;

    /**
     * @ORM\Column(type="string", length=30)
     * @Assert\Date
     * @Assert\NotBlank(message="Invalid: date required.")
     */
    private $dateTime;

    //* @Assert\LessThan("today UTC", message="Invalid Date. This is a past Date")
    //     * @Assert\GreaterThan("today UTC", message="Invalid Date. This is a future Date")
    //* @var string A "Y-m-d" formatted value

    /**
     * @ORM\ManyToOne(targetEntity=Site::class,inversedBy="pickupCollection")
     */
    private $site;

    /**
     * @return mixed
     */
    public function getSite()
    {
        return $this->site;
    }

    /**
     * @param mixed $site
     */
    public function setSite($site): void
    {
        $this->site = $site;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumCollected(): ?int
    {
        return $this->numCollected;
    }

    public function setNumCollected(int $numCollected): self
    {
        $this->numCollected = $numCollected;

        return $this;
    }

    public function getNumObstructed(): ?int
    {
        return $this->numObstructed;
    }

    public function setNumObstructed(int $numObstructed): self
    {
        $this->numObstructed = $numObstructed;

        return $this;
    }

    public function getNumContaminated(): ?int
    {
        return $this->numContaminated;
    }

    public function setNumContaminated(int $numContaminated): self
    {
        $this->numContaminated = $numContaminated;

        return $this;
    }

    public function getDateTime(): ?string
    {
        return $this->dateTime;
    }

    public function setDateTime(string $dateTime): self
    {
        $this->dateTime = $dateTime;

        return $this;
    }

}
