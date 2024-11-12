<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PasswordResetController extends AbstractController
{
    #[Route('/forgot-password', name: 'app_forgot_password')]
    public function forgotPassword(Request $request, UserRepository $userRepository): Response
    {
        // Formulaire envoyé
        if ($request->isMethod('POST')) {
            $email = $request->get('email');

            // Vérifier si l'email existe en base de données

            $user = $userRepository->findOneBy((['email' => $email]));

            if ($user) {
                // Si l'email existe,affiche un message de succés
                $this->addFlash('success', 'An email has been sent to you with password reset instructions.');
            } else {
                //Si l'email n'existe pas,affiche un message d'erreur
                $this->addFlash('error', 'This email does not exist in our system.');
            }
            // Redirige ve la même page pour afficher le message flash
            return $this->redirectToRoute('app_forgot_password');
        }
        // Rendre la vue avec le formulaire
        return $this->render('password_reset/index.html.twig');
    }
}
