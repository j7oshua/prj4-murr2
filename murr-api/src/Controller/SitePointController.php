<?php

namespace App\Controller;

use App\Repository\PointRepository;
use App\Repository\ResidentRepository;
use App\Repository\SiteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class SitePointController extends AbstractController
{
    public function index(): Response
    {
        /*
        return $this->render('site_point/index.html.twig', [
            'controller_name' => 'SitePointController',
        ]);
        */
    }
}
