<?php

namespace App\Controller;

use App\Entity\RecycleContainer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class RecycleContainerController extends AbstractController
{
    public static function replaceContainer(RecycleContainer $container1, RecycleContainer $container2) :bool
    {
        header('HTTP/1.1 501 Not Implemented');
    }

    public static function AddContainer(RecycleContainer $container1) :bool
    {
        header('HTTP/1.1 501 Not Implemented');
    }

    public static function removeContainer(RecycleContainer $container1) :bool
    {
        header('HTTP/1.1 501 Not Implemented');
    }

    public static function modifyContainer(RecycleContainer $container1) :bool
    {
        header('HTTP/1.1 501 Not Implemented');
    }

    public static function modifyLocation(RecycleContainer $container1, string $newlocation) :bool
    {
        header('HTTP/1.1 501 Not Implemented');
    }

    public static function isPickedUp(RecycleContainer $container1) :bool
    {
        header('HTTP/1.1 501 Not Implemented');
    }

    public static function getStatus(RecycleContainer $container1) :string
    {
        header('HTTP/1.1 501 Not Implemented');
    }

}