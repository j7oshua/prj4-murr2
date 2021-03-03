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

/**
 * Class SitePointController
 * @package App\Controller
 *
 * Controller used to do all of the adding points to the site residents.
 * Will receive the siteID from the url. Request object will be the pickupID coming from
 * the POST by the front end client. Uses the pickupID to gain information on how many
 * bins were collected. Then calculates the points based off of how many containers were
 * collected. Will loop though the site residents and add the correct amount of points
 * allocated to the site. Will return a response code and message.
 */
class SitePointController
{
    /**
     * @Route("/site/{id}", name="site_point")
     * @param int $id
     * @param PointRepository $pr
     * @param SiteRepository $ss
     * @return Response
     */
    public function index(int $id, PointRepository $pr, SiteRepository $ss): Response
    {
        // TODO: Implement adding points to site in here
    }
}
