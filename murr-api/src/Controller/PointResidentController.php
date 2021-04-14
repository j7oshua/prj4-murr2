<?php

namespace App\Controller;

use App\Repository\PointRepository;
use App\Repository\ResidentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PointResidentController extends AbstractController
{
    /**
     * @Route("/cusapi/points/{id}", name="point_resident")
     * @param int $id
     * @param PointRepository $pr
     * @param ResidentRepository $rr
     * @return Response
     * This will grab the id from the custom url to return the result json object.
     */
    public function index(int $id, PointRepository $pr, ResidentRepository $rr): Response
    {
        //This will grab the num_points of a resident id.
        $pointResult = $pr->GetPointByResident($id);

        //This will find a resident matching the resident id and if none are found it will return null.
        $idFound = $rr->find($id);

        //initialize sumTotal.
        $sumTotal = null;

        //Checks to see if resident exists
        if($idFound) {
            $sum = 0;
            //Goes through and adds each of residents point transaction to their sum
            foreach ($pointResult as $points) {
                $sum += $points['num_points'];
            }
            $sumTotal = $this->json($sum);
            $result = $this->json($sumTotal);
        }
        else {
            $result = $this->json(null);
            $result->setStatusCode(404);
        }
        return $result;
    }
}
