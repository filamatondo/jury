<<<<<<< HEAD
<?php

namespace App\Controller;

use App\Repository\UserRepository;
use SessionIdInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartController extends AbstractController
{

    /**
     * @Route("/panier", name="cart_index")
     */

    public function index($id, UserRepository $userRepository, SessionInterface $session)
    {

        $panier = $session->get('panier', []);
        $panierWithData = [];
        foreach ($panier as $id => $quantity) {
            $panierWithData[] = [
                'paroduit' => $userRepository->find($id),
                'quantity' => $quantity
            ];
        }
        $total = 0;
        foreach ($panierWithData as $item) {
            $totalItem = $item['product']->getPrice * $item['quantity'];
            $total += $totalItem;
        }

        return $this->render('cart/index.html.twig', [
            'items' => $panierWithData,
            'total' => $total

        ]);
    }


    /**
     * @Route("/panier/add/{id}", name="cart_add")
     */

    public function add($id, SessionInterface $session)
    {

        $panier = $session->get('panier', []);


        // si le produit existe déjà, alors rajoute moi un plus 1.
        if (!empty($panier[$id])) {
            $panier[$id]++;
        } else {
            $panier[$id] = 1;
        }


        //   rajoute un produits dans le panier. si le produit existe deja alors là il faut rajouter: 
        $panier[$id] = 1;

        $session->set('panier', $panier);

        dd($session->get('panier'));
    }


    /**
     * @Route("/panier/remove/{id}", name="cart_remove", methods={"GET","POST"})
     */

    public function remove($id, UserRepository $userRepository,  SessionIdInterface $session)
    {
        // $panier = $session->get('panier', []);

        if (!empty($panier[$id])) {
            unset($panier[$id]);
        }

        // $session->set('panier', $panier);

        return $this->redirectToRoute("cart_index");
    }
}
=======
<?php

namespace App\Controller;

use App\Repository\UserRepository;
use SessionIdInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartController extends AbstractController
{

    /**
     * @Route("/panier", name="cart_index")
     */

    public function index($id, UserRepository $userRepository, SessionInterface $session)
    {

        $panier = $session->get('panier', []);
        $panierWithData = [];
        foreach ($panier as $id => $quantity) {
            $panierWithData[] = [
                'paroduit' => $userRepository->find($id),
                'quantity' => $quantity
            ];
        }
        $total = 0;
        foreach ($panierWithData as $item) {
            $totalItem = $item['product']->getPrice * $item['quantity'];
            $total += $totalItem;
        }

        return $this->render('cart/index.html.twig', [
            'items' => $panierWithData,
            'total' => $total

        ]);
    }


    /**
     * @Route("/panier/add/{id}", name="cart_add")
     */

    public function add($id, SessionInterface $session)
    {

        $panier = $session->get('panier', []);


        // si le produit existe déjà, alors rajoute moi un plus 1.
        if (!empty($panier[$id])) {
            $panier[$id]++;
        } else {
            $panier[$id] = 1;
        }


        //   rajoute un produits dans le panier. si le produit existe deja alors là il faut rajouter: 
        $panier[$id] = 1;

        $session->set('panier', $panier);

        dd($session->get('panier'));
    }


    /**
     * @Route("/panier/remove/{id}", name="cart_remove", methods={"GET","POST"})
     */

    public function remove($id, UserRepository $userRepository,  SessionIdInterface $session)
    {
        // $panier = $session->get('panier', []);

        if (!empty($panier[$id])) {
            unset($panier[$id]);
        }

        // $session->set('panier', $panier);

        return $this->redirectToRoute("cart_index");
    }
}
>>>>>>> 586cd3136a80a2bc73c9e90930e5d4dce85100c9
