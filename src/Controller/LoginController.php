<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'app_login', methods: ['GET', 'POST'])]
    public function index(AuthenticationUtils $authenticationUtils, UserRepository $userRepository): Response
    {
        // Récupérer les erreus d'authentifications
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        // Vérifier si le dernier e-mail exista dans la base de données

        if ($lastUsername && $error) {
            $user = $userRepository->findOneBy(['email' => $lastUsername]);

            // Si l'utilisateur n'existe pas,ajouter un message flash spécifique

            if(!$user) {
                $this->addFlash('error',"Invalid login credentials.");
            } else {
                // Sinon, l'e-mail existe mais le mot de passe est incorrect
                $this->addFlash('error', "Invalid login credentials.");
            }
        }

        return $this->render('login/index.html.twig', [
            'error' => $error,
            'last_username' => $lastUsername,
        ]);
    }



    #[Route('/logout', name: 'app_logout')]
    public function logout(): never
    {
        

        throw new \Exception('Don\'t forget to activate logout in security.yaml');
    }
}
