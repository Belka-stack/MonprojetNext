<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AccountController extends AbstractController
{
    #[Route('/account', name: 'app_account')]
    public function index(): Response
    {
        return $this->render('account/index.html.twig');
    }
    
    #[Route('/account/modify-pwd', name: 'app_account_mofify_pwd')]
    public function password(): Response
    {
        return $this->render('account/password.html.twig');
    }
}