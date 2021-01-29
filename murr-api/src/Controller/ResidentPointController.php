<?php

namespace App\Controller;


use App\Repository\PointRepository;
use App\Repository\ResidentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ResidentPointController extends AbstractController
{
    /**
     * @Route("/resident/point/{id}", name="resident_point")
     * @param int $id
     * @param PointRepository $pr
     * @param ResidentRepository $rr
     * @return Response
     */
    public function index(int $id, PointRepository $pr, ResidentRepository $rr): Response
    {
        $pointResult = $pr->getPointByResident($id);
        $idFound = $rr->find($id);

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
