<?php


namespace App\Controller;


use App\Repository\AccountRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountController
{
    /**
     * @Route ("/account/{$id}", name=account)
     * @param int $id
     * @param AccountRepository $ac
     * @return Response
     */
    public function index(int $id, AccountRepository $ac) : Response
    {
        $account = $ac->GetAccountByResidentID($id);

        return $this->json($account);
    }


}