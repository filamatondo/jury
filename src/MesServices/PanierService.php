<?php

namespace App\MesServices;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

class PanierService
{
    protected $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    protected function getPanier()
    {
        return $this->session->get('panier', []);
    }

    protected function sauvegarderPanier($panier)
    {
        $this->session->set('panier', $panier);
    }


    public function ajouter(int $id)
    {
        // je vais chercher un panier
        $panier = $this->getPanier();

        // si dans le panier tu as déjà l'id. alors tu vas faire un qty+1
        // je verifie si j'ai déjà l'article dans mon panier.
        foreach ($panier as $item) {
            if ($item->id === $id) {

                // si j'ai j'augement la quantité de 1
                $item->qty = $item->qty + 1;
                $this->sauvegarderPanier($panier);
                return;
            }
        }
        // si j'ai pas, j'ajoute ce produit dans le panier

        $newItem = [
            'id' => $id,
            'qty' => 1
        ];

        $panier[] = $newItem;
        $this->sauvegarderPanier($panier);
        return;
    }
}
