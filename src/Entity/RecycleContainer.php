<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

class RecycleContainer
{
    /**
     * @ORM\Column(type="string")
     */
    public $SiteID;
    /**
     * @ORM\Column(type="string")
     */
    private  $serialNumber;
    /**
     * @ORM\Column(type="string")
     */
    private $containerType;
    /**
     * @ORM\Column(type="string")
     */
    public  $location;
    /**
     * @ORM\Column(type="ArrayList", nullable = true)
     */
    private  $collectionHistory;
    /**
     * @ORM\Column(type="bool")
     */
    private  $contaminated;
    /**
     * @ORM\Column(type="bool")
     */
    private  $construction;
    /**
     * @ORM\Column(type="bool")
     */
    private $accessible;
    /**
     * @ORM\Column(type="string",length=30)
    */
    private  $other;

    /**
     * RecycleContainer constructor.
     * @param string $SiteID
     * @param string $serialNumber
     * @param string $containerType
     * @param string $location
     * @param array|null $collectionHistory
     * @param bool $contaminated
     * @param bool $construction
     * @param bool $accessible
     * @param string|null $other
     */
    public function __construct(string $SiteID, string $serialNumber, string $containerType, string $location,
                                ?array $collectionHistory, bool $contaminated, bool $construction, bool $accessible, ?string $other)
    {
        $this->SiteID = $SiteID;
        $this->serialNumber = $serialNumber;
        $this->containerType = $containerType;
        $this->location = $location;
        $this->collectionHistory = $collectionHistory;
        $this->contaminated = $contaminated;
        $this->construction = $construction;
        $this->accessible = $accessible;
        $this->other = $other;
    }

    /**
     * @return s|string
     */
    public function getSiteID()
    {
        return $this->SiteID;
    }

    /**
     * @return string
     */
    public function getSerialNumber(): string
    {
        return $this->serialNumber;
    }

    /**
     * @return string
     */
    public function getContainerType(): string
    {
        return $this->containerType;
    }

    /**
     * @return string
     */
    public function getLocation(): string
    {
        return $this->location;
    }

    /**
     * @return array|null
     */
    public function getCollectionHistory(): ?array
    {
        return $this->collectionHistory;
    }

    /**
     * @return bool
     */
    public function isContaminated(): bool
    {
        return $this->contaminated;
    }

    /**
     * @return bool
     */
    public function isConstruction(): bool
    {
        return $this->construction;
    }

    /**
     * @return bool
     */
    public function isAccessible(): bool
    {
        return $this->accessible;
    }

    /**
     * @return string|null
     */
    public function getOther(): ?string
    {
        return $this->other;
    }

    /**
     * @param string $location
     */
    public function setLocation(string $location): void
    {
        $this->location = $location;
    }

    /**
     * @param array|null $collectionHistory
     */
    public function setCollectionHistory(?array $collectionHistory): void
    {
        $this->collectionHistory = $collectionHistory;
    }

    /**
     * @param bool $contaminated
     */
    public function setContaminated(bool $contaminated): void
    {
        $this->contaminated = $contaminated;
    }

    /**
     * @param bool $construction
     */
    public function setConstruction(bool $construction): void
    {
        $this->construction = $construction;
    }

    /**
     * @param bool $accessible
     */
    public function setAccessible(bool $accessible): void
    {
        $this->accessible = $accessible;
    }

    /**
     * @param string|null $other
     */
    public function setOther(?string $other): void
    {
        $this->other = $other;
    }



}