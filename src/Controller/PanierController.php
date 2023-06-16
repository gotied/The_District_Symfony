<?php

namespace App\Controller;

use App\Service\PanierService;
use App\Repository\PlatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class PanierController extends AbstractController
{
    // #[Route('/panier', name: 'app_panier')]
    // public function index(): Response
    // {
    //     return $this->render('panier/index.html.twig', [
    //         'controller_name' => 'PanierController',
    //     ]);
    // }

    private $panierService;

    public function __construct(PanierService $panierService)
    {
        $this->panierService = $panierService;
    }

    #[Route('/panier/ajout/{id}', name: 'panier_ajout')]
    public function ajouterPlat(Request $request, int $id): Response
    {
        $this->panierService->ajouterPlat($id);
        $this->addFlash('success', 'Plat ajouté au panier.');
        return $this->redirect($request->headers->get('referer'));
    }

    #[Route('/panier/suppression/{id}', name: 'panier_suppression')]
    public function supprimerPlat(Request $request, int $id): Response
    {
        $this->panierService->supprimerPlat($id);
        $this->addFlash('success', 'Plat supprimé du panier.');
        return $this->redirect($request->headers->get('referer'));
    }

    #[Route('/panier/vider', name: 'panier_vider')]
    public function viderPanier(Request $request): Response
    {
        $this->panierService->viderPanier();
        $this->addFlash('success', 'Le panier a été vidé.');
        return $this->redirect($request->headers->get('referer'));
    }

    #[Route('/panier', name: 'panier_affichage')]
    public function afficherPanier(PlatRepository $plat): Response
    {
        $contenuPanier = $this->panierService->getContenuPanier();
        $panierPlatId = array_keys($contenuPanier);
        $panierPlat = $plat->findBy(['id' => $panierPlatId]);


        return $this->render('panier/index.html.twig', [
            'contenuPanier' => $contenuPanier,
            'panierPlat' => $panierPlat,
        ]);
    }
}
