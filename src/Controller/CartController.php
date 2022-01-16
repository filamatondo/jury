<?php

namespace App\Controller;

use App\MesServices\PanierService;
use App\Repository\UserRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartController extends AbstractController
{

    /**
     * @Route("/panier/ajouter/{id}", name="panier_ajouter")
     */

    public function ajouter(int $id, UserRepository $userRepository, PanierService $panierService, SessionInterface $sessionInterface)
    {
        // le produit que je vais ajouter est égale à.. le formulaire d'ajout 
        $user = $userRepository->find($id);

        // si le produit ajouter n'est pas, je vais t'en renvoyer. 
        if (!$user) {
            throw $this->createNotFoundException("Le produit n'existe pas");
        }

        $panierService->ajouter($id);
        dd($this->session->get('panier'));

        return $this->redirectToRoute('home', ['id' => $user->getId()]);
    }




    // /**
    //  * @Route("/delete/{id}", name="delete")
    //  */
    // public function delete(User $user, SessionInterface $session)
    // {
    //     // On récupère le panier actuel
    //     $panier = $session->get("panier", []);
    //     $id = $user->getId();

    //     if (!empty($panier[$id])) {
    //         unset($panier[$id]);
    //     }

    //     // On sauvegarde dans la session
    //     $session->set("panier", $panier);

    //     return $this->redirectToRoute("cart_index");
    // }

    // /**
    //  * @Route("/delete", name="delete_all")
    //  */
    // public function deleteAll(SessionInterface $session)
    // {
    //     $session->remove("panier");

    //     return $this->redirectToRoute("cart_index");
    // }
}
