<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Entity\Detail;
use App\Repository\PlatRepository;
use App\Repository\UtilisateurRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommandeController extends AbstractController
{
    #[Route('/commande', name: 'app_commande')]
    public function index(Request $request, EntityManagerInterface $entityManager, PlatRepository $plat, UtilisateurRepository $user): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        
        $panier = $request->getSession()->get('panier');
        $idPlats = array_keys($panier);
        $plats = $plat->findBy(['id' => $idPlats]);

        $dateCommande = new DateTime();

        if ($request->isMethod('POST')) {
            
            $idUser = $request->request->get('id_user');
            $utilisateur = $user->find($idUser);
            $date = $request->request->get('date');
            $total = $request->request->get('total');
            $etat = $request->request->get('etat');

            $date = DateTime::createFromFormat('Y-m-d', $date);
            
            $commande = new Commande();
            $commande->setUtilisateur($utilisateur);
            $commande->setDateCommande($date);
            $commande->setTotal($total);
            $commande->setEtat($etat);

            $entityManager->persist($commande);
            $entityManager->flush();

            foreach ($plats as $plat) {
                $quantite = $request->request->get('quantite_' . $plat->getId());
                $idPlat = $plat->getId();

                $detail = new Detail();
                $detail->setQuantite($quantite);
                $detail->setPlat($plat);
                $detail->setCommande($commande);

                $entityManager->persist($detail);
            }

            $entityManager->flush();

            $request->getSession()->remove('panier');
            
            return $this->redirectToRoute('app_profil');
        }

        return $this->render('commande/index.html.twig', [
            'controller_name' => 'CommandeController',
            'plat' => $plats,
            'date' => $dateCommande
        ]);
    }
}
