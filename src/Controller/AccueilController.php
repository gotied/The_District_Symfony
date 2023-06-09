<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategorieRepository;
use App\Repository\DetailRepository;
use Doctrine\ORM\EntityManagerInterface;

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
    public function top6cat(DetailRepository $detailRepo, CategorieRepository $cat, EntityManagerInterface $entityManager)
    {
        // $top6cat = $cat->top6cat($entityManager);
        $top6cat = $detailRepo->top6cat();

        return $this->render('accueil/index.html.twig', [
            'top6cat' => $top6cat,
        ]);
    }
}
