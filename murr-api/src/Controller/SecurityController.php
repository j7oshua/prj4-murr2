<?php

namespace App\Controller;
header('Access-Control-Expose-Headers: Location, Set-Cookie');
header("Access-Control-Allow-Credentials: true");

use ApiPlatform\Core\Api\IriConverterInterface;
use PHPUnit\TextUI\Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\Validator\Constraints\DateTime;


class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login", methods={"POST"})
     * @param IriConverterInterface $iriConverter
     */
    public function login(IriConverterInterface $iriConverter)
    {

        if (!$this->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->json([
                'error' => 'Invalid login request: check that the Content-Type header is "application/json".'
            ], 400);
        }
        return new Response(null, 204, [
            'Location' => $iriConverter->getIriFromItem($this->getUser())
        ]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new Exception("should not be reached");
    }
}