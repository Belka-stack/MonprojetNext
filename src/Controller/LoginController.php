<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
        // Gérer les erreurs

        $error = $authenticationUtils->getLastAuthenticationError();

        // Dernier username (email)

        $lastUsername = $authenticationUtils->getLastUsername();


        return $this->render('login/index.html.twig', [

            // on passe nos deux variables à notre fichier twig
            'error' => $error,
            'last_username' => $lastUsername,
        ]);
    }
    #[Route('/logout', name: 'app_logout', methods: ['GET'])]
    public function logout(): never
    {
        

        throw new \Exception(message: 'Don\'t forget to activate logout in security.yaml');
    }
}
