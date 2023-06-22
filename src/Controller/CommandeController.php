<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Form\CommandeFormType;
use App\Repository\PlatRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommandeController extends AbstractController
{
    #[Route('/commande', name: 'app_commande')]
    public function index(Request $request, EntityManagerInterface $entityManager, PlatRepository $plat): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        
        $form = $this->createForm(CommandeFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $commande = new Commande();
            $data = $form->getData();
            $commande = $data;

            $entityManager->persist($commande);
            $entityManager->flush();
        }

        $panier = $request->getSession()->get('panier');
        $id = array_keys($panier);
        $idPlat = $plat->findBy(['id' => $id]);

        return $this->render('commande/index.html.twig', [
            'controller_name' => 'CommandeController',
            'form' => $form,
            'plat' => $idPlat
        ]);
    }
}
