<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\PointRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\PersistentCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=PointRepository::class)
 */
class Point
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected ?int $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private ?int $numPoint;

    /**
     * @ORM\ManyToMany(targetEntity=Resident::class, inversedBy="points")
     * @ORM\JoinColumn (name="reference_id", referencedColumnName="id")
     */
    private Collection $resident;

    
    public function __construct()
    {
        $this->resident = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPoint(): ?int
    {
        return $this->numPoint;
    }

    public function setPoint(?int $numPoint): self
    {
        $this->numPoint = $numPoint;

        return $this;
    }

    /**
     * @return Collection|Resident[]
     */
    public function getResident(): Collection
    {
        return $this->resident;
    }

    public function addResident(Resident $resident): self
    {
        if (!$this->resident->contains($resident)) {
            $this->resident[] = $resident;
        }

        return $this;
    }

    public function removeResident(Resident $resident): self
    {
        $this->resident->removeElement($resident);

        return $this;
    }
}
