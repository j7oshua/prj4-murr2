<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\PointRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;

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
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $numPoints;

    /**
     * @ORM\Column(type="integer")
     * @ManyToOne(targetEntity="Resident")
     * @JoinColumn(name="resident_id", referencedColumnName="id")
     */
    private $resident_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumPoints(): ?int
    {
        return $this->numPoints;
    }

    public function setNumPoints(int $numPoints): self
    {
        $this->numPoints = $numPoints;

        return $this;
    }

    public function getResidentId(): ?int
    {
        return $this->resident_id;
    }

    public function setResidentId(int $resident_id): self
    {
        $this->resident_id = $resident_id;

        return $this;
    }
}
