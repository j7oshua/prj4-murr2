<?php

namespace App\Controller;

use App\Entity\Resident;
use App\Repository\PointRepository;
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
     * @return Response
     */
    public function index(int $id, PointRepository $pr): Response
    {
//        return $this->render('resident_point/index.html.twig', [
//            'controller_name' => 'ResidentPointController',
//        ]);

        $result = $pr->getPointByResident($id);

        $sum = 0;

        //if no id or -1
        //$result["statusCode"] = 404

        foreach($result as $points){
            $sum += $points['numPoints'];
        }



        $response = $this->json($sum);
        //var_dump($response);

        return $this -> json($response);
    }
}
