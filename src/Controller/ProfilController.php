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
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use DateTime;

class ProfilController extends AbstractController
{
    #[Route('/profil', name: 'app_profil')]
    public function index(CommandeRepository $commande, DetailRepository $detail, PlatRepository $plat, UtilisateurRepository $utilisateur, Request $request, EntityManagerInterface $entitymanager, MailerInterface $mailer): Response
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

                    $expediteur = 'commande@the_district.fr';
                    $user = $commande->getUtilisateur();
                    $destinataire = $user->getEmail();
                    $sujet = 'Commande annulée';
                    $message = "Nous vous confirmons que votre commande est bien annulée." . PHP_EOL . "À bientôt sur The District.";

                    $email = (new Email())
                        ->from($expediteur)
                        ->to($destinataire)
                        ->subject($sujet)
                        ->text($message);

                    $mailer->send($email);

                    $gerantEmail = 'admin@the_district.fr';
                    $gerantSujet = 'Annulation de commande';
                    $date = new DateTime();
                    $gerantMessage = "L'utilisateur " . $user->getEmail() . " a annulé sa commande du " . $date->format('d/m/Y H:i:s');

                    $email = (new Email())
                        ->from($expediteur)
                        ->to($gerantEmail)
                        ->subject($gerantSujet)
                        ->text($gerantMessage);

                    $mailer->send($email);

                    $this->addFlash('success', 'Votre commande a bien été annulée !');
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

            $expediteur = 'admin@the_district.fr';
            $destinataire = $user->getEmail();
            $sujet = 'Bonjour ' . $user->getPrenom();
            $message = "Vos nouvelles informations personnelles ont bien été enregistrées !" . PHP_EOL . PHP_EOL . "À bientôt sur The District. ";

            $email = (new Email())
                ->from($expediteur)
                ->to($destinataire)
                ->subject($sujet)
                ->text($message);

            $mailer->send($email);

            $this->addFlash('success', 'Vos informations ont bien été enregistrées !');
        }

        return $this->render('profil/index.html.twig', [
            'controller_name' => 'ProfilController',
            'commande' => $c,
            'detail' => $d,
            'plat' => $p
        ]);
    }
}
