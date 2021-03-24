<?php

namespace App\Entity;

use App\Repository\PickUpRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PickUpRepository::class)
 */
class PickUp
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Site::class, inversedBy="pickupCollection")
     * @ORM\JoinColumn(nullable=false)
     */
    private $siteObject;

    /**
     * @ORM\Column(type="integer")
     */
    private $numCollected;

    /**
     * @ORM\Column(type="integer")
     */
    private $numObstructed;

    /**
     * @ORM\Column(type="integer")
     */
    private $numContaminated;

    /**
     * @ORM\Column(type="string")
     */
    private $dateTime;

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
        return $this->dateTime;
    }

    public function setDate(string $dateTime): self
    {
        $this->dateTime = $dateTime;

        return $this;
    }
}
