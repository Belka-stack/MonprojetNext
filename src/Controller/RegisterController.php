<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterUserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RegisterController extends AbstractController
{ 
    // Change le '/register' en '/inscription'
    #[Route('/register', name: 'app_register', methods: ['GET', 'POST'])]

    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
    
        $form = $this->createForm(RegisterUserType::class,$user);
        
        // On demande à notre formulaire d'écouter la requête.

        $form->handleRequest($request);


        // Vérifie si le formulaire est soumis et en plus s'il est valid.

        if ($form->isSubmitted() && $form->isValid()) {
            
            

            // alors tu enregistre les datas en BBD 

            $entityManager->persist($user);
            $entityManager->flush();

            //et tu envoies un message de confirmation du compte bien créé.

            $this->addFlash(
                'success',
                'Your account is correctly created, please log in.'
            );
            // Redirection vers la page de connection

            return $this->redirectToRoute('app_login');
        
        }
        

        
        // et tu envoies un message de confirmation du compte bien créé.

        return $this->render('register/index.html.twig',[ 

        // enlèvement du paramètre 'controller_name' => 'RegisterController' proposé par défault et j'ajoute la création d'une vue dans une variable registreForm.



        'registerForm' => $form->createView()

    ]);
            
    
    }
}
