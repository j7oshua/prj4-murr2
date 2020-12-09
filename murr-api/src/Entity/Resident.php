<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ResidentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=ResidentRepository::class)
 */
class Resident
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\OneToOne (targetEntity="ResidentProfile", mappedBy="resident")
     */
    private $residentProfile;

   public function _construct()
   {
       $this->residentProfile = new ArrayCollection();
   }

    /**
     * @return Collection
     */
    public function getResidentProfile():Collection
    {
        return $this->residentProfile;
    }

    public function addResidentProfile(ResidentProfile $residentProfile):self
    {
        if(!$this->residentProfile->contains($residentProfile)) {
            $this->residentProfile[] = $residentProfile;
        }
        return $this;
    }

    public function removeResidentProfile(ResidentProfile $residentProfile):self
    {
        $this->residentProfile->removeElement($residentProfile);
        return $this;
    }


    public function getId(): ?int
    {
        return $this->id;
    }



}
