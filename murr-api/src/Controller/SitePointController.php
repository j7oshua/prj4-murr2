<?php

namespace App\Controller;

use ApiPlatform\Core\Hal\Serializer\ObjectNormalizer;
use App\Entity\Resident;
use App\Repository\SiteRepository;
use App\Repository\PickUpRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\ResidentRepository;

use App\Entity\Point;
use App\Entity\Site;
use App\Entity\PickUp;
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
     * @param PickUpRepository $pur
     * @return Response
     */
    public function index(int $id , Request $request, SiteRepository $ss, PickUpRepository $pur): Response
    {
        //find the site using $id
        $site = $ss->findSiteById($id);
        //get the json object from $request
        $content = $request->getContent();
        // decode the json object to get the pickup ID
        $pickUpIDJson = json_decode($content);
        // get the pickup id from the decoded json object
        $pickupID = $pickUpIDJson->{'pickupID'};
        // find the pickup object using the pickup id
        $pickup = $pur->findPickupById($pickupID);
        //initialize a new response object
        $response = new Response();
        //
        $entityManager = $this->getDoctrine()->getManager();

        // Check to see if the site object returned exists or not. If not, return status code 400 and error message
        if ($site == null)
        {
            //set response code to 400
            $response->setStatusCode(400);
            $response->setContent('Site was not found');
        }
        // Check to see if the pickup object returned exists or not. If not, return status code 400 and error message
        else if ($pickup == null)
        {
            //set response code to 422
            $response->setStatusCode(422);
            $response->headers->set('error', 'PickUp ID not found');
        }
        else
        {
            //calculate the points to be added
            $collected = $pickup->getNumCollected();
            $totalBins = $site->getNumBins();
            //percentage is rounded off with a precision of 1
            $ptPercentage = round(($collected / $totalBins), 1);
            $sitePoints = (int) ($ptPercentage * 100);

            //check the amount of points, if it's zero, do not save to database. return a message
            if ($sitePoints == 0)
            {
                $response->setContent('No points were added to '.$site->getSiteName());
            }
            else
            {
                //get the residents that live in the site
                $residents = $site->getResidents();
                // initialize a new point object
                $point = new Point();
                //set the points into the point object
                $point->setnum_points($sitePoints);
                //loop through the residents and add the points to each resident
                foreach ($residents as $findResident)
                {
                    $resident = $entityManager->getRepository(Resident::class)->find($findResident->getId());
                    $resident->addPoint($point);
                }
                //save changes to the database
                $entityManager->persist($point);
                $entityManager->flush();
                //set the success message and status code (201)
                $response->setContent($sitePoints.' Points successfully added to '.$site->getSiteName());
                $response->setStatusCode(201);
            }
        }

        return $response;
    }
}
