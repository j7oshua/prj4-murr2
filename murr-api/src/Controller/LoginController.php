<?php


namespace App\Controller;


use App\Repository\ResidentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController
{
    /**
     * @Route("/residents/{id}", name="resident")
     * @param int $id
     * @param ResidentRepository $rr
     * @return Response
     * This will get the resident entered information in and send back if they can log in or not
     */
    public function checkLogin(int $id, ResidentRepository $rr): Response
    {

    }

}