<?php
namespace App\Service;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

class PanierService
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function ajouterPlat(int $platId)
    {
        $panier = $this->session->get('panier', []);
        $panier[$platId] = ($panier[$platId] ?? 0) + 1;
        $this->session->set('panier', $panier);
    }

    public function supprimerPlat(int $platId)
    {
        $panier = $this->session->get('panier', []);
        if (isset($panier[$platId])) {
            unset($panier[$platId]);
            $this->session->set('panier', $panier);
        }
    }

    public function viderPanier()
    {
        $this->session->remove('panier');
    }

    public function getContenuPanier()
    {
        return $this->session->get('panier', []);
    }
}