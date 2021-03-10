<?php

namespace App\Controller;

use App\Repository\SiteRepository;
use App\Repository\PickupRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Entity\Point;
use App\Entity\Site;
use App\Entity\Pickup;
use Symfony\Component\Routing\Annotation\Route;

use Doctrine\ORM\EntityManagerInterface;

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
class SitePointController extends AbstractController
{
    /**
     * @Route("/site_point/{id}", name="site_point")
     * @param int $id
     * @param SiteRepository $ss
     * @param PickupRepository $pur
     * @return Response
     */
    public function index(int $id, SiteRepository $ss, PickupRepository $pur): Response
    {
        $site = $ss->findSiteById($id);
        $request = Request::createFromGlobals();
        $content = $request->getContent();
        $pickup = $pur->findPickupById($pickupID);
        $response = new Response();
        $entityManager = $this->getDoctrine()->getManager();

        // Check to see if the site object returned exists or not. If not, return status code 400 and error message
        if ($site == null)
        {
            $response->setStatusCode(400);
            $response->setContent('Site was not found');
        }
        // Check to see if the pickup object returned exists or not. If not, return status code 400 and error message
        else if ($pickup == null)
        {
            $response->setStatusCode(400);
            $response->setContent('Pickup ID was not found');
        }
        else
        {
            $collected = $pickup->getNumCollected();
            $totalBins = $site->getNumBins();

            $ptPercentage = ($totalBins - $collected) / $totalBins;
            $sitePoints = (int) ($ptPercentage * 100);

            $residents = $site->getResidents();
            $point = new Point();
            $point->setnum_points($sitePoints);
            foreach ($residents as $resident)
            {
                $point->addResident($resident);
            }

            $entityManager->persist($point);

            $entityManager->flush();

            $response->getStatusCode();
            $response->getContent();
        }

        return $response;
    }
}
