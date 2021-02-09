<?php


namespace App\Controller;

use App\Repository\ResidentRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LoginController
{


    /**
     * @Route("/login")
     * @param ResidentRepository $residentRepository
     * @param array $reqInfo
     * @return Response
     * This method will grab the resident that corresponds to the password and login info passed in
     */
    public function residentLogin(array $reqInfo, ResidentRepository $residentRepository): Response
    {

    }
}