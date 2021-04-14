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

class
PickUpController extends AbstractController
{
    /**
     * @Route("/cusapi/pickups", name="add_pickup", methods={"POST"})
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
        if(!is_numeric($pickUpArrayInfo['siteId'])){
            return $this->json(['Invalid: site required.'])->setStatusCode(404);
        }
        if (!is_numeric($pickUpArrayInfo['numCollected']) || !is_numeric($pickUpArrayInfo['numObstructed']) || !is_numeric($pickUpArrayInfo['numContaminated']) )
        {
            return $this->json(["Invalid: Bin input required."])->setStatusCode(400);
        }
        $site = $siteRepo->find($pickUpArrayInfo['siteId']);

        try {
            if ($site == NULL) { //this catches if it is not in the database
                return $this->json(["Item not found for site " . $pickUpArrayInfo['siteId'] . "."])->setStatusCode(404);
            } else if ($pickUpArrayInfo['numCollected'] + $pickUpArrayInfo['numObstructed'] + $pickUpArrayInfo['numContaminated'] == $site->getNumBins()) {

                $pickUpObject = new PickUp();
                $pickUpObject->setNumCollected($pickUpArrayInfo['numCollected']);
                $pickUpObject->setNumObstructed($pickUpArrayInfo['numObstructed']);
                $pickUpObject->setNumContaminated($pickUpArrayInfo['numContaminated']);
                $pickUpObject->setDate(date("Y-m-d")); //use the servers date time instead
                $pickUpObject->setSiteObject($site);

                $violations = [];
                foreach ($validator->validate($pickUpObject) as $violation) {
                    $violations[] = $violation->getMessage();
                }
                if (empty($violations)) {
                      $pickup = $pickupRepo->save($pickUpObject);
                    return $this->json($pickup);

                }else{
                    return $this->json($violations)->setStatusCode(422);
                }
            } else {
                return $this->json(['site: Number of bins do not match.'])->setStatusCode(400);

            }
        }catch (\ErrorException $e){ //this catches if a string is inputted as one or all of the bins
            return $this->json(['Invalid: Bin input error.'])->setStatusCode(400);
        }
    }
}
