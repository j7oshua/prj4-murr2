<?php

namespace App\Controller;

use App\Repository\PickUpRepository;
use App\Repository\SiteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\PickUp;
use App\Entity\Site;

class PickupController extends AbstractController
{
    /**
     * @Route("/pickups", name="pickup")
     * @param Request $request
     * @param PickUpRepository $pRep
     * @param SiteRepository $sRep
     * @return Response
     */
    public function index( Request $request,PickUpRepository $pRep, SiteRepository $sRep): Response
    {
        $pickID2 = 0;
        $site = $sRep;
        $pickup = $pRep;
        //$request = Request::createFromGlobals();
        $content = $request ->getcontent();
        $json = json_decode($content);
        var_dump($json);
        //$siteNumBins = $json->{'numBins'};
        $pickCollected = $json->{'numCollected'};
        $pickObstruct = $json->{'numObstructed'};
        $pickContam = $json->{'numContaminated'};
        $pickDateT = $json->{'dateTime'};
        $pickID  = $json->{'siteObject'};
        $pickID2 = str_ireplace("/api/sites/", "", $pickID);
        $siteId = $site->find($pickID2);
        //var_dump($siteId);
        //$siteBins = $site->{'numBins'};
        $siteBins = $site->GetNumbinsByID($pickID2);
        var_dump($siteBins);
        $pickNumbins = $siteBins[0];
        $pickNumbins2 = $pickNumbins['numBins'];
        var_dump($pickNumbins2);
        //$pickColBin = $pickup->findBy($pickCollected);
        //$pickObBin = $pickup->findBy($pickObstruct);
        //$pickConBin = $pickup->findBy($pickContam);
        //this will need to be fixed
        //$pickDateTime = $pickup->findBy($pickDateT);
        $response = new Response();
        $entityManager = $this->getDoctrine()->getManager();


        //create a variable the sums all the bins together
        $countedBins = $pickCollected + $pickObstruct + $pickContam;

        var_dump($countedBins);

        //Check to see if the number of bins matches the number of counted Bins
        if ($countedBins != $pickNumbins2)
        {
            $response = $this->json(['hydra:description' => 'site: Number of bins do not match.']);
            $response->setStatusCode(400);
            //$response->setContent('Number of bins do not match.');
        }
        //checks if the site id is not null
        elseif ($siteId == null)
        {
            $response = $this->json(['hydra:description' => 'site was not found']);
            $response->setStatusCode(404);
            //$response->setContent("Site was not found");
        }
        //check to see if the  pickup object was successfully added
        else{
            // NOTE **** put all of this in a tempPickup object
            $tempPickup = new PickUp();

            $tempPickup->setNumCollected($pickCollected);
            $tempPickup->setNumObstructed($pickObstruct);
             $tempPickup->setNumContaminated($pickContam);
            $tempPickup->setDateTime((string)$pickDateT);


            //var_dump($tempPickup->getNumCollected());
            //var_dump($siteId);
            $tempPickup->setSiteObject($siteId);
            //var_dump($pRep->getMaxId());
            //$DummyID= $pRep->getMaxId();
            //if($DummyID == NULL){ $tempPickup->setId(1);}else{ $tempPickup->setId( 1 + $DummyID);}
            var_dump($tempPickup->getId());
            $entityManager ->persist($tempPickup);
            // so I think this isn't giving us the proper saving we need, may need to go group api platform on this controller
            //https://symfony.com/doc/current/doctrine.html idk it should work but i wonder if api platform is the problem.
            $entityManager->flush();

            if($response->getStatusCode() == 201)
            {
                //$response->setContent("Submitted");
                //$fullpickup = $this->json($tempPickup);
                $response = $this->json($tempPickup);
                var_dump($response);
            }elseif ($response->getStatusCode() == 200 )
            {
               //$response->setContent("Submitted");
                //$fullpickup = $this->json($tempPickup);
                $response = $this->json($tempPickup);
                var_dump($response);
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
