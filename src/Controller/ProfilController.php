<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Commande;
use App\Repository\CommandeRepository;
use App\Repository\DetailRepository;
use App\Repository\PlatRepository;
use App\Repository\UtilisateurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class ProfilController extends AbstractController
{
    #[Route('/profil', name: 'app_profil')]
    public function index(CommandeRepository $commande, DetailRepository $detail, PlatRepository $plat, UtilisateurRepository $utilisateur ,Request $request, EntityManagerInterface $entitymanager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $user = $request->getSession()->get('_security.last_username');
        $userID = $utilisateur->findBy(['email' => $user]);
        $c = $commande->findBy(['utilisateur' => $userID]);
        $d = $detail->findBy(['commande' => $c]);
        $p = $plat->findAll();

        if ($request->isMethod('GET')) {
            $etat = $request->query->get('etat');
            if (is_numeric($etat)) {
                $id = $request->query->get('id');
                $commande = $commande->find($id);
                if ($commande) {
                    $commande->setEtat($etat);
                    $entitymanager->flush();
                }
            }
        }

        if ($request->isMethod('POST')) {
            $userID = $request->request->get('id_user');
            $user = $utilisateur->find($userID);
            $nom = $request->request->get('nom');
            $prenom = $request->request->get('prenom');
            $tel = $request->request->get('telephone');
            $adresse = $request->request->get('adresse');
            $cp = $request->request->get('cp');
            $ville = $request->request->get('ville');
            
            $user->setNom($nom);
            $user->setPrenom($prenom);
            $user->setTelephone($tel);
            $user->setAdresse($adresse);
            $user->setCp($cp);
            $user->setVille($ville);

            $entitymanager->persist($user);
            $entitymanager->flush();
        }

        return $this->render('profil/index.html.twig', [
            'controller_name' => 'ProfilController',
            'commande' => $c,
            'detail' => $d,
            'plat' => $p,
            // 'user' => $userId
        ]);
    }
}
