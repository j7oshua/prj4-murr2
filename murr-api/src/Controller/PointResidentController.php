<?php

namespace App\Controller;

use App\Repository\PointRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PointResidentController
{
    /**
     * @Route("/point/{id}", name="point_resident")
     */
    public function index(int $id, PointRepository $pr): Response
    {
        $response = $pr->getPointByResident($id);
        return $this -> json($response);
    }
}
