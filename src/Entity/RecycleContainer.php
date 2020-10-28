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
    private $serialNumber;
    /**
     * @ORM\Column(type="string")
     */
    private $containerType;
    /**
     * @ORM\Column(type="string")
     */
    public $location;
    /**
     * @ORM\Column(type="ArrayList", nullable = true)
     */
    private $collectionHistory;
    /**
     * @ORM\Column(type="bool")
     */
    private $contaminated;
    /**
     * @ORM\Column(type="bool")
     */
    private $construction;
    /**
     * @ORM\Column(type="bool")
     */
    private $accessible;
    /**
     * @ORM\Column(type="string",length=30)
    */
    private $other;





}