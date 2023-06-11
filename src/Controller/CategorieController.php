<?php

namespace App\Controller;

use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategorieController extends AbstractController
{
    #[Route('/categorie', name: 'app_categorie')]
    public function index(): Response
    {
        return $this->render('categorie/index.html.twig', [
            'controller_name' => 'CategorieController',
        ]);
    }

    #[Route('/categorie', name: 'app_categorie')]
    public function allcat(CategorieRepository $cat)
    {
        $allcat = $cat->allcat();
        return $this->render('categorie/index.html.twig', [
            'allcat' => $allcat,
        ]);
    }
}
