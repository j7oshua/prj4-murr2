<?php

namespace App\Entity;

use App\Repository\PickupRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PickupRepository::class)
 */
class Pickup
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Site::class, inversedBy="numCollected")
     * @ORM\JoinColumn(nullable=false)
     */
    private $site;

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
     * @ORM\Column(type="datetime")
     */
    private $dateTime;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSiteID(): ?Site
    {
        return $this->site;
    }

    public function setSiteID(?Site $siteID): self
    {
        $this->site = $siteID;

        return $this;
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

    public function getDateTime(): ?\DateTimeInterface
    {
        return $this->dateTime;
    }

    public function setDateTime(\DateTimeInterface $dateTime): self
    {
        $this->dateTime = $dateTime;

        return $this;
    }
}
