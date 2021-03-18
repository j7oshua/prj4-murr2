<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\SiteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Validator as AcmeAssert;


/**
 * @ApiResource(
 *     collectionOperations={"post", "get"},
 *     itemOperations={"get"}
 * )
 * @ORM\Entity(repositoryClass=SiteRepository::class)
 */
class Site
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $siteName;

    /**
     * @ORM\Column(type="integer")
     */
    private $numBins;

    /**
     * @ORM\OneToMany(targetEntity=Pickup::class,mappedBy="siteObject")
     */
    private $pickupCollection;

    /**
     * @return ArrayCollection
     */
    public function getPickupCollection(): ArrayCollection
    {
        return $this->pickupCollection;
    }

    public function __construct()
    {
        $this->pickupCollection = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSiteName(): ?string
    {
        return $this->siteName;
    }

    public function setSiteName(string $siteName): self
    {
        $this->siteName = $siteName;

        return $this;
    }

    public function getNumBins(): ?int
    {
        return $this->numBins;
    }

    public function setNumBins(int $numBins): self
    {
        $this->numBins = $numBins;

        return $this;
    }
}
