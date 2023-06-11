<?php

namespace App\Controller;

use App\Repository\PlatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PlatController extends AbstractController
{
    #[Route('/plat', name: 'app_plat')]
    public function index(): Response
    {
        return $this->render('plat/index.html.twig', [
            'controller_name' => 'PlatController',
        ]);
    }

    #[Route('/plat/{id?}', name: 'app_plat')]
    public function plat(PlatRepository $plat, ?int $id = null)
    {
        $allplat = $plat->allplat();
        $PlatParCat = $plat->PlatParCat($id);
        
        return $this->render('plat/index.html.twig', [
            'allplat' => $allplat,
            'PlatParCat' => $PlatParCat,
        ]);
    }
}
