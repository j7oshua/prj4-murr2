<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\SiteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Controller\SitePointController;

/**
 * @ORM\Entity(repositoryClass=SiteRepository::class)
 * @ApiResource(
 *     collectionOperations={
 *      "get",
 *      "post"
 *     },
 *     itemOperations={
 *      "get"={
 *      "method"="GET",
 *      "path"="/site/{siteName}"
 *     },
 *      "post_site_points"={
 *          "method"="POST",
 *          "path"="/site/pickup/{id}",
 *          "controller"=SitePointController::class
 *      }
 *     }
 * )
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
     * @ORM\Column(type="string", length=100)
     * @Assert\Regex(
     *     pattern="/^[A-Za-z]/",
     *     match=true,
     *     message="Site name cannot have a number"
     * )
     * @Assert\Length(
     *     min = 3,
     *     max = 100,
     *     minMessage = "The site name has to be at least {{ limit }} characters long",
     *     maxMessage = "The site name cannot be longer than {{ limit }} characters"
     * )
     */
    private $siteName;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Positive(
     *      message="Site needs to have at least one bin"
     * )
     */
    private $numBins;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $residents = [];

    /**
     * @ORM\OneToMany(targetEntity=Pickup::class, mappedBy="site")
     */
    private $pickupCollection;

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

    public function getResidents(): ?array
    {
        return $this->residents;
    }

    public function setResidents(?array $residents): self
    {
        $this->residents = $residents;

        return $this;
    }

    /**
     * @return Collection|Pickup[]
     */
    public function getPickupCollection(): Collection
    {
        return $this->pickupCollection;
    }

    public function addPickupCollection(Pickup $numCollected): self
    {
        if (!$this->pickupCollection->contains($numCollected)) {
            $this->pickupCollection[] = $numCollected;
            $numCollected->setSiteID($this);
        }

        return $this;
    }

    public function removePickupCollection(Pickup $numCollected): self
    {
        if ($this->pickupCollection->removeElement($numCollected)) {
            // set the owning side to null (unless already changed)
            if ($numCollected->getSiteID() === $this) {
                $numCollected->setSiteID(null);
            }
        }

        return $this;
    }
}
