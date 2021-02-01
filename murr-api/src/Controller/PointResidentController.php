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
     * @Route("/point/resident/{id}", name="point_resident")
     * @param int $id
     * @param PointRepository $pr
     * @param ResidentRepository $rr
     * @return Response
     * This will grab the id from the custom url to return the result json object.
     */
    public function index(int $id, PointRepository $pr, ResidentRepository $rr): Response
    {
        //This will grab the numPoints of a resident id.
        $pointResult = $pr->GetPointByResident($id);
        //This will find a resident matching the resident id and if none are found it will return null.
        $idFound = $rr->find($id);
        //initialize response.
        $response = null;

        if($idFound) {
            $sum = 0;
            foreach ($pointResult as $points) {
                $sum += $points['numPoints'];
            }
            $response = $this->json($sum);
            $result = $this->json($response);
        } else {
            $result = $this->json($response);
            $result->setStatusCode(404);
        }

        return $result;

    }
}
