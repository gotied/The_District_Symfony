<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CommandeRepository;
use App\Repository\DetailRepository;

class ProfilController extends AbstractController
{
    #[Route('/profil', name: 'app_profil')]
    public function index(CommandeRepository $commande, DetailRepository $detail): Response
    {
        $co = $commande->findAll();
        $de = $detail->findAll();
        return $this->render('profil/index.html.twig', [
            'controller_name' => 'ProfilController',
            'commande' => $co,
            'detail' => $de
        ]);
    }
}
