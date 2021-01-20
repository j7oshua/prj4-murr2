<?php

namespace App\Controller;

use App\Repository\PointRepository;
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
        $response = $pr->getPointByResident($id);
        return $this -> json($response);
    }
}
