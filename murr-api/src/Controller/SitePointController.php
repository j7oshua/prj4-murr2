<?php

namespace App\Controller;

use ApiPlatform\Core\Hal\Serializer\ObjectNormalizer;
use App\Entity\Resident;
use App\Repository\SiteRepository;
use App\Repository\PickupRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\ResidentRepository;

use App\Entity\Point;
use App\Entity\Site;
use App\Entity\Pickup;
use Symfony\Component\Routing\Annotation\Route;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\Serializer;

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
     * @Route("/site/{id}", name="site_point")
     * @param int $id
     * @param Request $request
     * @param SiteRepository $ss
     * @param PickupRepository $pur
     * @return Response
     */
    public function index(int $id , Request $request, SiteRepository $ss, PickupRepository $pur): Response
    {
        $site = $ss->findSiteById($id);
        $content = $request->getContent();
        $json = json_decode($content);
        $pickupID = $json->{'pickupID'};
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
            $response->setStatusCode(422);
            $response->headers->set('error', 'Pickup ID not found');
        }
        else
        {
            $collected = $pickup->getNumCollected();
            $totalBins = $site->getNumBins();

            $ptPercentage = round(($collected / $totalBins), 1);
            $sitePoints = (int) ($ptPercentage * 100);

            if ($sitePoints == 0)
            {
                $response->setContent('No points were added to '.$site->getSiteName());
            }
            else
            {
                $residents = $site->getResidents();

                $point = new Point();

                $point->setnum_points($sitePoints);

                foreach ($residents as $findResident)
                {
                    $resident = $entityManager->getRepository(Resident::class)->find($findResident->getId());
                    $resident->addPoint($point);
                }

                $entityManager->persist($point);
                $entityManager->flush();
                $response->setContent($sitePoints.' Points successfully added to '.$site->getSiteName());
            }
        }

        return $response;
    }
}
