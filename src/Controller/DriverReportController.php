<?php

namespace App\Controller;

use App\Entity\Container;
use PhpParser\Node\Scalar\String_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DriverReportController extends AbstractController
{
    public static function ListContainers(string $driver) :array
    {
        header('HTTP/1.1 501 Not Implemented');
    }

    public static function GetContainer() :RecycleContainer
    {
        header('HTTP/1.1 501 Not Implemented');
    }

    public static function GetSiteID() :int
    {
        header('HTTP/1.1 501 Not Implemented');
    }

    public static function GetSerialNumber() :int
    {
        header('HTTP/1.1 501 Not Implemented');
    }

    public static function GetLocation() :string
    {
        header('HTTP/1.1 501 Not Implemented');
    }

    public static function GetCurContamination() :bool
    {
        header('HTTP/1.1 501 Not Implemented');
    }


}
