<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\PickUpRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
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
     * @ORM\Column(type="string", length=30)
     */
    private $dateTime;

    /**
     * @ORM\ManyToOne(targetEntity=Site::class, inversedBy="pickupid")
     * @ORM\JoinColumn(nullable=false)
     */
    private $siteobject;

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

    public function getSiteobject(): ?Site
    {
        return $this->siteobject;
    }

    public function setSiteobject(?Site $siteobject): self
    {
        $this->siteobject = $siteobject;

        return $this;
    }
}
