<?php

namespace App\Controller;

use App\Repository\PickUpRepository;
use App\Repository\SiteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\PickUp;
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
        $pickCollected = $json->{'numCollected'};
        $pickObstruct = $json->{'numObstructed'};
        $pickContam = $json->{'numContaminated'};
        $pickDateT = $json->{'dateTime'};
        $siteId = $site->find($id);
        $siteBins = $site->findBy($siteNumBins);
        $pickColBin = $pickup->findBy($pickCollected);
        $pickObBin = $pickup->findBy($pickObstruct);
        $pickConBin = $pickup->findBy($pickContam);
        $pickDateTime = $pickup->findBy($pickDateT);
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
            $tempPickup = new PickUp();

            $tempPickup->setNumCollected($pickCollected);
            $tempPickup->setNumObstructed($pickObstruct);
             $tempPickup->setNumContaminated($pickContam);
            $tempPickup->setDateTime((string)$pickDateTime);

            $tempPickup->setSiteObject($site->find((array)$siteId));

            $entityManager ->persist($tempPickup);
            $entityManager->flush();

            if($response->getStatusCode() == 201)
            {
                $response->setContent("Submitted");
            }elseif ($response->getStatusCode() == 200 )
            {
               $response->setContent("Submitted");
            }else{
                $response->setContent("Error Cannot Submit");
            }


        }

        //return the response
        return $response;

//        return $this->render('pickup/index.html.twig', [
//            'controller_name' => 'PickupController',
//        ]);
    }
}
