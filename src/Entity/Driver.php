<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

class Driver
{
    /**
     * @ORM\Column(type="string")
     */
    private $vehicleID;
    /**
     * @ORM\Column(type="string")
     */
    private $DriverID;
    /**
     * @ORM\Column(type="string")
     */
    private $FirstName;
    /**
     * @ORM\Column(type="string")
     */
    private $LastName;
}