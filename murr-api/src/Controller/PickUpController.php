<?php

namespace App\Controller;

use App\Entity\PickUp;
use App\Entity\Site;
use App\Repository\PickUpRepository;
use App\Repository\SiteRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class PickUpController extends AbstractController
{
    /**
     * @Route("/pickups", name="add_pickup", methods={"POST"})
     */
    public function addPickup (Request $request, PickUpRepository $pickupRepo, SiteRepository $siteRepo, ValidatorInterface $validator): Response
    {


        //brings an array
        $pickUpArrayInfo = json_decode($request->getContent(),true);
        $site = $siteRepo->find($pickUpArrayInfo['siteId']);

        if($site == NULL){
            //return error message
        }else if($pickUpArrayInfo['numCollected'] + $pickUpArrayInfo['numObstructed'] + $pickUpArrayInfo['numContaminated'] == $site->getNumBins()){


            $pickUpObject = new PickUp();
            $pickUpObject->setNumCollected($pickUpArrayInfo['numCollected']);
            $pickUpObject->setNumObstructed($pickUpArrayInfo['numObstructed']);
            $pickUpObject->setNumContaminated($pickUpArrayInfo['numContaminated']);
            $pickUpObject->setDateTime(date("Y-m-d")); //use the servers date time instead
            $pickUpObject->setSiteObject($site);

            $result = [];
            foreach ($validator->validate($pickUpObject) as $violation) {
                $result[$violation->getPropertyPath()] = $violation->getMessage();
            }
            if (empty($result)) {
                $pickupRepo->save($pickUpObject);
                return $this->json($pickUpObject);
            }else{

                return $this->json($result);
            }
        }else{
            //return error that the bins do not match.
        }
       // return $this->json($$pickUpObject);
    }
}
