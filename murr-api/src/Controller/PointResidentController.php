<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PointResidentController extends AbstractController
{
    /**
     * @Route("/point/resident", name="point_resident")
     */
    public function index(int $id, PointRepository $pr): Response
    {
        $response = $pr->getPointByResident($id);
        return $this -> json($response);
    }
}
