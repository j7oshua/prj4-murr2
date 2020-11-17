<?php

namespace App\Entity;

use App\Repository\ContainerRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ContainerRepository::class)
 */
class Container
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
    private $serialNum;

    /**
     * @ORM\Column(type="integer")
     */
    private $siteID;

    /**
     * @ORM\Column(type="string",  length=50)
     */
    private $Location;

    /**
     * @ORM\Column(type="boolean")
     */
    private $Contamination;

    /**
     * @ORM\Column(type="boolean")
     */
    private $Graffiti;

    public function getId(): int
    {
        return $this->id;
    }

    public function getSerialNum(): int
    {
        return $this->serialNum;
    }

    public function setSerialNum(int $serialNum): self
    {
        $this->serialNum = $serialNum;

        return $this;
    }

    public function getSiteID(): int
    {
        return $this->siteID;
    }

    public function setSiteID(int $siteID): self
    {
        $this->siteID = $siteID;

        return $this;
    }

    public function getLocation(): string
    {
        return $this->Location;
    }

    public function setLocation(string $Location): self
    {
        $this->Location = $Location;

        return $this;
    }

    public function getContamination(): bool
    {
        return $this->Contamination;
    }

    public function setContamination(bool $Contamination): self
    {
        $this->Contamination = $Contamination;

        return $this;
    }

//    public function getGraffiti(): bool
//    {
//        return $this->Graffiti;
//    }
//
//    public function setGraffiti(bool $Graffiti): self
//    {
//        $this->Graffiti = $Graffiti;
//
//        return $this;
//    }
}
