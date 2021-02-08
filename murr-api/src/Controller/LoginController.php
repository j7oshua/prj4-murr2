<?php


namespace App\Controller;

use App\Repository\ResidentRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LoginController
{

    /**
     * @Route("/point/resident/{id}", name="point_resident")
     * @param ResidentRepository $residentRepository
     * @param array $reqInfo
     * @return Response
     * This method will grab the resident that corresponds to the password and login info passed in
     */
    public function index(array $reqInfo, ResidentRepository $residentRepository): Response
    {

    }
}