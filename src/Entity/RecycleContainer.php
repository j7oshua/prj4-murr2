<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

class RecycleContainer
{
    /**
     * @ORM\Column(type="string")
     */
    public string $SiteID;
    /**
     * @ORM\Column(type="string")
     */
    private string $serialNumber;
    /**
     * @ORM\Column(type="string")
     */
    private string $containerType;
    /**
     * @ORM\Column(type="string")
     */
    public string $location;
    /**
     * @ORM\Column(type="ArrayList", nullable = true)
     */
    private array|null $collectionHistory;
    /**
     * @ORM\Column(type="bool")
     */
    private bool $contaminated;
    /**
     * @ORM\Column(type="bool")
     */
    private bool $construction;
    /**
     * @ORM\Column(type="bool")
     */
    private bool $accessible;
    /**
     * @ORM\Column(type="string",length=30)
    */
    private bool $other;

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


}