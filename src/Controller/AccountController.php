<?php

namespace App\Controller;

use App\Form\PasswordUserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AccountController extends AbstractController
{
    #[Route('/account', name: 'app_account')]
    public function index(): Response
    {
        return $this->render('account/index.html.twig');
    }

    #[Route('/account/modify-pwd', name: 'app_account_modify_pwd')]

    // On utilise les injection de dépendances UserPasswordHasherInterface $passwordHasher pour hascher et verifier le mot de passe et on aimerait les passer à notre formulaire.

    public function password(Request $request, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager): Response
    {
    
        $user = $this->getUser();

        // En troisième paramètre de ma méthode createForm,j'ajoute un tableau et dans ce tableau nous pouvons envoyer des infos à notre formulaire.

        $form = $this->createForm(PasswordUserType::class,$user, [
            'passwordHasher' => $passwordHasher
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $entityManager->flush();// Pour mettre à jour BDD 
            $this->addFlash(
                'success',
                'Your password is correctly updated'
            );
        }

        return $this->render('account/password.html.twig', [
            'modifyPwd' => $form->createView()
        ]);
    }
}