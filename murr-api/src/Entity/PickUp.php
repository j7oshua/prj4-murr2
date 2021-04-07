<?php

namespace App\Entity;


use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\PickUpRepository;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ApiResource(
 * )
 * @ORM\Entity(repositoryClass=PickUpRepository::class)
 */
class PickUp
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @Assert\PositiveOrZero(message="ID must be a positive number")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
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
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity=Site::class,inversedBy="pickupCollection")
     * @ORM\JoinColumn(nullable=false)
     */
    private $siteObject;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSite(): ?Site
    {
        return $this->siteObject;
    }

    public function setSite(?Site $siteObject): void
    {
        $this->siteObject = $siteObject;

    }

    public function getSiteObject(): ?Site
    {
        return $this->siteObject;
    }

    public function setSiteObject(?Site $siteObject): void
    {
        $this->siteObject = $siteObject;

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

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(string $date): self
    {
        $this->date = $date;

        return $this;
    }
}
