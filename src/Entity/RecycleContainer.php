<?php

namespace App\Entity;

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
     * @ORM\Column(type="bool", nullable=true)
     */
    private $contaminated;
    /**
     * @ORM\Column(type="bool", nullable=true)
     */
    private $construction;
    /**
     * @ORM\Column(type="bool", nullable=true)
     */
    private $accessible;
    /**
     * @ORM\Column(type="string",length=30, nullable=true)
    */
    private $other;





}