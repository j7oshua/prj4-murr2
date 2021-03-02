<?php

namespace App\Controller;

use App\Repository\PointRepository;
use App\Repository\ResidentRepository;
use App\Repository\SiteRepository;
use App\Repository\PickupRepository;
use Symfony\Component\HttpFoundation\Response;

use App\Entity\Point;
use App\Entity\Site;
use App\Entity\Pickup;
use Symfony\Component\Routing\Annotation\Route;

class SitePointController
{
    /**
     * @Route("/site/{id}", name="site_point")
     * @param int $id
     * @param PointRepository $pr
     * @param SiteRepository $sr
     * @param PickupRepository $pkr
     * @param ResidentRepository $rr
     * @return Response
     */
    public function index(int $id, PointRepository $pr, SiteRepository $sr, PickupRepository $pkr, ResidentRepository $rr): Response
    {
        // TODO: Implement adding points to site in here
    }
}
