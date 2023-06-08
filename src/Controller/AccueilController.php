<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategorieRepository;

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
    public function top6cat(CategorieRepository $cat)
    {
        $top6cat = $cat->top6cat();

        return $this->render('accueil/index.html.twig', [
            'top6cat' => $top6cat,
        ]);
    }
}
