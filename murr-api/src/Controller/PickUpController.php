<?php

namespace App\Controller;
//header("Access-Control-Allow-Origin: *");

use App\Entity\PickUp;
use App\Entity\Site;
use App\Repository\PickUpRepository;
use App\Repository\SiteRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use phpDocumentor\Reflection\DocBlock\Description;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class PickUpController extends AbstractController
{
    /**
     * @Route("/pickups", name="add_pickup", methods={"POST"})
     * @param Request $request
     * @param PickUpRepository $pickupRepo
     * @param SiteRepository $siteRepo
     * @param ValidatorInterface $validator
     * @return Response
     */
    public function addPickup(Request $request, PickUpRepository $pickupRepo, SiteRepository $siteRepo, ValidatorInterface $validator): Response
    {


        //brings an array
        $pickUpArrayInfo = json_decode($request->getContent(), true);
        try {
            $site = $siteRepo->find($pickUpArrayInfo['siteId']);
        }catch (ORMException $e) //this catches the null site
        {
            $result = Null;
            $result = $this->json(['Invalid: site required.']);
            return $result->setStatusCode(404);
        }catch (\ErrorException $e){ //this catches if its a string
            $result = Null;
            $result = $this->json(['Invalid: site required.']);
            return $result->setStatusCode(400);
        }

        try {
            if ($site == NULL) { //this catches if it is not in the database
                $stringID = (string)$pickUpArrayInfo['siteId'];
                $result = Null;
                $result = $this->json(["Item not found for site " . $stringID . "."]);
                return $result->setStatusCode(404);
            } else if ($pickUpArrayInfo['numCollected'] + $pickUpArrayInfo['numObstructed'] + $pickUpArrayInfo['numContaminated'] == $site->getNumBins()) {

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
                      $result = $pickupRepo->save($pickUpObject);
                    return $this->json($result);

                }else{
                    return $this->json($result);
                }
            } else {

                $pickUpObject2 = new PickUp();
                try {
                    $pickUpObject2->setNumCollected($pickUpArrayInfo['numCollected']);
                    $pickUpObject2->setNumObstructed($pickUpArrayInfo['numObstructed']);
                    $pickUpObject2->setNumContaminated($pickUpArrayInfo['numContaminated']);
                    $pickUpObject2->setDateTime(date("Y-m-d")); //use the servers date time instead
                    $pickUpObject2->setSiteObject($site);
                } catch (\TypeError $e) { //this is if a null is passed
                    $result = $this->json(['Invalid: Bin input required.']);
                    $result->setStatusCode(400);
                    //return $result->setContent($e);
                    return $result;
                }

                $result = [];
                foreach ($validator->validate($pickUpObject2) as $violation) {
                    $result[$violation->getPropertyPath()] = $violation->getMessage();
                }
                if(empty($result)){ //this is usually for if the bins total is incorrect
                    $result = ['site: Number of bins do not match.'];
                }
                $result2 = $this->json($result);
                //$result2->setContent($result);
                return $result2->setStatusCode(400);

            }
        }catch (\ErrorException $e){ //this catches if a string is inputted as one or all of the bins
            $result = $this->json(['Invalid: Bin input error.']);
            $result->setStatusCode(400);
            //return $result->setContent($e);
            return $result;
        }
    }
}
