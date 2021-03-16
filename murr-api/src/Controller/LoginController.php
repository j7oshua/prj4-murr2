<?php


namespace App\Controller;


use App\Repository\ResidentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController
{
    /**
     * @Route("/resident/{id}", name="resident")
     * @param int $id
     * @param ResidentRepository $rr
     * @return Response
     */
    public function checkLogin(int $id, ResidentRepository $rr): Response
    {

    }
}