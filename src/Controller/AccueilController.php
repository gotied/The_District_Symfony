<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\DetailRepository;
use App\Repository\PlatRepository;
use Symfony\Component\HttpFoundation\Request;

class AccueilController extends AbstractController
{
    #[Route('/accueil', name: 'app_accueil')]
    public function index(): Response
    {
        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
        ]);
    }
    
    #[Route('/accueil', name: 'app_accueil')]
    public function top(DetailRepository $detailRepo, PlatRepository $plat, Request $request)
    {
        $top6cat = $detailRepo->top6cat();
        $top3plat = $detailRepo->top3plat();
        $searchTerm = $request->query->get('search', '');
        $recherche = [];
        if (!empty($searchTerm)) {
        $recherche = $plat->search($searchTerm);
        }
        return $this->render('accueil/index.html.twig', [
            'top6cat' => $top6cat,
            'top3plat' => $top3plat,
            'recherche' => $recherche
        ]);
    }
}
