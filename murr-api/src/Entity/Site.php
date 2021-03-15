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
 * @ApiResource()
 * @ORM\Entity(repositoryClass=SiteRepository::class)
 */
class Site
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Assert\PositiveOrZero(message="Must be a positive number")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=80)
     * @Assert\NotNull(message="Site name required")
     */
    private $siteName;

    /**
     * @ORM\Column(type="integer")
     * @Assert\PositiveOrZero(message="Bins must be a positive integer")
     * @Assert\NotNull(message="Invalid: bin input required.")
     */
    private $numBins;

    /**
     * @ORM\OneToMany(targetEntity=PickUp::class, mappedBy="siteObject")
     */
    private $pickupid;

    public function __construct()
    {
        $this->pickupid = new ArrayCollection();
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

    /**
     * @return Collection|PickUp[]
     */
    public function getPickupid(): Collection
    {
        return $this->pickupid;
    }

    public function addPickupid(PickUp $pickupid): self
    {
        if (!$this->pickupid->contains($pickupid)) {
            $this->pickupid[] = $pickupid;
            $pickupid->setSiteobject($this);
        }

        return $this;
    }

    public function removePickupid(PickUp $pickupid): self
    {
        if ($this->pickupid->removeElement($pickupid)) {
            // set the owning side to null (unless already changed)
            if ($pickupid->getSiteobject() === $this) {
                $pickupid->setSiteobject(null);
            }
        }

        return $this;
    }
}
