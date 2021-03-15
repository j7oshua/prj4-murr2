<?php

namespace App\Controller;

use App\Repository\PickUpRepository;
use App\Repository\SiteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\PickUp:
use App\Entity\Site;

class PickupController extends AbstractController
{
    /**
     * @Route("/pickup", name="pickup")
     */
    public function index(int $id, PickUpRepository $pRep, SiteRepository $sRep): Response
    {
        $site = $sRep;
        $pickup = $pRep;
        $request = Request::createFromGlobals();
        $content = $request ->getcontent();
        $json = json_decode($content);
        $siteNumBins = $json->{'numBins'};
        $pickCollected = $json->{'numColledted'};
        $pickObstruct = $json->{'numObstructed'};
        $pickContam = $json->{'numContaminated'};
        $siteId = $site->find($id);
        $siteBins = $site->findBy($siteNumBins);
        $pickColBin = $pickup->findBy($pickCollected);
        $pickObBin = $pickup->findBy($pickObstruct);
        $pickConBin = $pickup->findBy($pickContam);
        $response = new Response();
        $entityManager = $this->getDoctrine()->getManager();


        //create a variable the sums all the bins together
        $countedBins = $pickColBin + $pickObBin + $pickConBin;

        //Check to see if the number of bins matches the number of counted Bins
        if ($countedBins != $siteBins)
        {
            $response->setStatusCode(400);
            $response->setContent('Number of bins do not match.');
        }
        //checks if the site id is not null
        elseif ($siteId == null)
        {
            $response->setStatusCode(404);
            $response->setContent("Site was not found");
        }
        //check to see if the  pickup object was successfully added
        else{
            // NOTE **** put all of this in a tempPickup object

            $collected = $pickup->setNumCollected($pickCollected);
            $obstructed = $pickup->setNumObstructed($pickObstruct);
            $contaminated = $pickup->setNumContaminated($pickContam);

            //DateTime added to this

            $siteoject = $site->getId();

            $entityManager ->persist($tempPickup);
            $entityManager->flush();

            if($response->getStatusCode() == 201)
            {
                $response->setContent("Sunmitted");
            }elseif ($response->getStatusCode() == 200 )
            {
               $response->setContent("sSubmitted");
            }


        }

        //return the response
        return $response;

//        return $this->render('pickup/index.html.twig', [
//            'controller_name' => 'PickupController',
//        ]);
    }
}
