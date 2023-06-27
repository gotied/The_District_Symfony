<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CommandeRepository;
use App\Repository\DetailRepository;
use App\Repository\PlatRepository;
use App\Repository\UtilisateurRepository;
use Symfony\Component\HttpFoundation\Request;

class ProfilController extends AbstractController
{
    #[Route('/profil', name: 'app_profil')]
    public function index(CommandeRepository $commande, DetailRepository $detail, PlatRepository $plat, UtilisateurRepository $utilisateur ,Request $request): Response
    {
        $user = $request->getSession()->get('_security.last_username');
        $userId = $utilisateur->findBy(['email' => $user]);
        $c = $commande->findBy(['utilisateur' => $userId]);
        $d = $detail->findBy(['commande' => $c]);
        // $p = $plat->findBy(['detail' => $d]);

        return $this->render('profil/index.html.twig', [
            'controller_name' => 'ProfilController',
            'commande' => $c,
            'detail' => $d,
            // 'plat' => $p,
            'user' => $userId
        ]);
    }
}
