<?php

namespace App\Controller;

use App\Entity\RecycleContainer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class DriverReportController extends AbstractController
{
    public static function isPickedUp(bool $status) :bool
    {
        header('HTTP/1.1 501 Not Implemented');
    }

    public static function getStatus(RecycleContainer $container1) :string
    {
        header('HTTP/1.1 501 Not Implemented');
    }
    public static function setStatus(RecycleContainer $container1) :bool
    {
        header('HTTP/1.1 501 Not Implemented');
    }

    public static function ListContainers(string $driver) :array
    {
        header('HTTP/1.1 501 Not Implemented');
    }

    public static function SetContaminated(RecycleContainer $container1, bool $status) :bool
    {
        header('HTTP/1.1 501 Not Implemented');
    }

    public static function SetConstruction(RecycleContainer $container1, bool $status) :bool
    {
        header('HTTP/1.1 501 Not Implemented');
    }

    public static function SetInaccessible(RecycleContainer $container1, bool $status) :bool
    {
        header('HTTP/1.1 501 Not Implemented');
    }
    public static function SetOther(RecycleContainer $container1, string $status) :bool
    {
        header('HTTP/1.1 501 Not Implemented');
    }
    public static function SubmitReport(RecycleContainer $container1, string $status) :bool
    {
        header('HTTP/1.1 501 Not Implemented');
    }

}