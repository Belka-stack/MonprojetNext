<?php

namespace App\Controller\Account;

use App\Repository\OrderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class OrderController extends AbstractController
{
   #[Route('/account/order/{id_order}', name: 'app_account_order')]
   public function index($id_order, OrderRepository $orderRepository): Response
   {
      // Récupérer l'utilisateur connecté
      $user = $this->getUser();

      // Chercher la commande par ID et vérifier qu'elle appartient à l'utilisateur connecté
      $order = $orderRepository->findOneBy([
         'id' => $id_order,
         'user' => $user
      ]);

      // Si la commande n'existe pas ou n'appartient pas à l'utilisateur, rediriger vers la page des commandes ou d'accueil
      if (!$order) {
         return $this->redirectToRoute('app_account');  // Redirige vers la page des commandes de l'utilisateur ou d'accueil
      }

      // Si la commande existe et appartient à l'utilisateur, afficher les détails
      return $this->render('account/order/index.html.twig', [
         'order' => $order,
      ]);
   }
}
