<?php
namespace App\Service;

use Symfony\Component\HttpFoundation\RequestStack;

class PanierService
{
    private $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    public function ajouterPlat(int $platId)
    {
        $request = $this->getCurrentRequest();
        $session = $request->getSession();

        $panier = $session->get('panier', []);
        $panier[$platId] = ($panier[$platId] ?? 0) + 1;
        $session->set('panier', $panier);
    }

    public function supprimerPlat(int $platId)
    {
        $request = $this->getCurrentRequest();
        $session = $request->getSession();

        $panier = $session->get('panier', []);
        if (isset($panier[$platId])) {
            unset($panier[$platId]);
            $session->set('panier', $panier);
        }
    }

    public function viderPanier()
    {
        $request = $this->getCurrentRequest();
        $session = $request->getSession();
        $session->remove('panier');
    }

    public function getContenuPanier()
    {
        $request = $this->getCurrentRequest();
        $session = $request->getSession();
        return $session->get('panier', []);
    }

    private function getCurrentRequest()
    {
        return $this->requestStack->getCurrentRequest();
    }

    public function modifierQuantite(int $platId, int $quantite)
    {
        $request = $this->getCurrentRequest();
        $session = $request->getSession();
        $panier = $session->get('panier', []);

        if ($quantite > 0) {
            $panier[$platId] = $quantite;
        } else {
            unset($panier[$platId]);
        }

        $session->set('panier', $panier);
    }
}
