<?php

namespace App\Controller;

use App\Entity\Resident;
use App\Repository\PointRepository;
use App\Repository\ResidentRepository;
use Doctrine\ORM\EntityManager;
use PHPUnit\Framework\Constraint\JsonMatches;
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
//        return $this->render('resident_point/index.html.twig', [
//            'controller_name' => 'ResidentPointController',
//        ]);
//        var_dump($rr->find(4));

        $result = $pr->getPointByResident($id);
        var_dump($result);
        $response = null;

        if($result) {
            $sum = 0;
            foreach ($result as $points) {
                $sum += $points['numPoints'];
            }
            $response = $this->json($sum);
        } else {
            http_response_code(404);
        }
        var_dump(http_response_code());
        var_dump($this -> json($response));
        return $this -> json($response);
    }
}
