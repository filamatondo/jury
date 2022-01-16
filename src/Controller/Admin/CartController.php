<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Products;
use App\Repository\UserRepository;
use App\Repository\ProductsRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin/cart", name="cart_")
 */
class CartController extends AbstractController
{
    /**
     * @Route("/", name="admin_cart_index")
     */
    public function index(SessionInterface $session, UserRepository $userRepository)
    {
        $panier = $session->get("panier", []);

        // On "fabrique" les données
        $dataPanier = [];
        $total = 0;

        foreach ($panier as $id => $quantite) {
            $user = $userRepository->find($id);
            $dataPanier[] = [
                "user" => $user,
                "quantite" => $quantite
            ];
        }

        return $this->render('admin/admin_cart/index.html.twig', compact("dataPanier", "total"));
    }

    /**
     * @Route("/admin/add/{id}", name="admin_add")
     */
    public function add(User $user, SessionInterface $session)
    {
        // On récupère le panier actuel
        $panier = $session->get("panier", []);
        $id = $user->getId();

        if (!empty($panier[$id])) {
            $panier[$id]++;
        } else {
            $panier[$id] = 1;
        }

        // On sauvegarde dans la session
        $session->set("panier", $panier);

        return $this->redirectToRoute("admin_cart_index");
    }

    /**
     * @Route("/admin/remove/{id}", name="admin_remove")
     */
    public function remove(User $user, SessionInterface $session)
    {
        // On récupère le panier actuel
        $panier = $session->get("panier", []);
        $id = $user->getId();

        if (!empty($panier[$id])) {
            if ($panier[$id] > 1) {
                $panier[$id]--;
            } else {
                unset($panier[$id]);
            }
        }

        // On sauvegarde dans la session
        $session->set("panier", $panier);

        return $this->redirectToRoute("admin/admin_cart/cart_index");
    }

    /**
     * @Route("/delete/{id}", name="admin_delete")
     */
    public function delete(User $user, SessionInterface $session)
    {
        // On récupère le panier actuel
        $panier = $session->get("panier", []);
        $id = $user->getId();

        if (!empty($panier[$id])) {
            unset($panier[$id]);
        }

        // On sauvegarde dans la session
        $session->set("panier", $panier);

        return $this->redirectToRoute("admin_cart_index");
    }

    /**
     * @Route("/delete", name="delete_all")
     */
    public function deleteAll(SessionInterface $session)
    {
        $session->remove("panier");

        return $this->redirectToRoute("admin_cart_index");
    }
}
