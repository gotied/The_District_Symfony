<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Entity\Detail;
use App\Repository\PlatRepository;
use App\Repository\UtilisateurRepository;
use App\Service\MailService;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class CommandeController extends AbstractController
{
    #[Route('/commande', name: 'app_commande')]
    public function index(Request $request, EntityManagerInterface $entityManager, PlatRepository $plat, UtilisateurRepository $user, MailerInterface $mailer): Response
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

            $expediteur = 'commande@the_district.fr';
            $destinataire = $utilisateur->getEmail();
            $sujet = 'Commande du ' . $date->format('d-m-Y');
            $message = "Votre commande :\n\n";

            foreach ($plats as $plat) {
                $quantite = $request->request->get('quantite_' . $plat->getId());
                $libelle = $plat->getLibelle();

                $message .= $libelle . " (Quantité : " . $quantite . ")\n";
            }

            $message .= "Total : " . $total . " €\n";
            $message .= "\nAdresse de livraison :\n" . $utilisateur->getNom() . " " . $utilisateur->getPrenom() . "\n" . $utilisateur->getAdresse() . ", \n" . $utilisateur->getCp() . ' ' . $utilisateur->getVille();
            $message .= "\n" . $utilisateur->getTelephone() . "\n\nNous vous tiendrons informés de l'état de votre commande et de sa livraison !\nÀ bientôt sur The District.";

            $email = (new Email())
                ->from($expediteur)
                ->to($destinataire)
                ->subject($sujet)
                ->text($message);

            $mailer->send($email);

            $gerantEmail = 'admin@the_district.fr';
            $gerantSujet = 'Nouvelle commande - Récapitulatif';

            $gerantMessage = "Une nouvelle commande a été passée.\n\n";
            $gerantMessage .= "Informations de l'utilisateur :\n";
            $gerantMessage .= "Adresse e-mail : " . $utilisateur->getEmail() . "\n";
            $gerantMessage .= "Numéro de téléphone : " . $utilisateur->getTelephone() . "\n";
            $gerantMessage .= "Adresse de livraison :\n";
            $gerantMessage .= $utilisateur->getNom() . " " . $utilisateur->getPrenom() . "\n";
            $gerantMessage .= $utilisateur->getAdresse() . "\n";
            $gerantMessage .= $utilisateur->getCp() . " " . $utilisateur->getVille() . "\n\n";

            $gerantMessage .= "Détails de la commande :\n";
            foreach ($plats as $plat) {
                $quantite = $request->request->get('quantite_' . $plat->getId());
                $libelle = $plat->getLibelle();

                $gerantMessage .= $libelle . " (Quantité : " . $quantite . ")\n";
            }
            $gerantMessage .= "Total : " . $total." €";

            $gerantEmail = (new Email())
                ->from($expediteur)
                ->to($gerantEmail)
                ->subject($gerantSujet)
                ->text($gerantMessage);

            $mailer->send($gerantEmail);


            $request->getSession()->remove('panier');

            $this->addFlash('success', 'Votre commande a été enregistrée avec succès !');
            return $this->redirectToRoute('app_profil');
        }

        return $this->render('commande/index.html.twig', [
            'controller_name' => 'CommandeController',
            'plat' => $plats,
            'date' => $dateCommande
        ]);
    }
}
