<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PointSystemController extends AbstractController
{

    public function addResident(array $reqData, Resident $newResident)
    {
        header('HTTP/1.1 501 Not Implemented');
    }

    public static function populateResident(array $reqData, Resident &$resident, array &$violations = []):bool
    {
        header('HTTP/1.1 501 Not Implemented');
    }
}
