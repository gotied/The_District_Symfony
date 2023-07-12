<?php

namespace App\EventSubscriber;

use App\Entity\Commande;
use App\Entity\Detail;
use App\Repository\CommandeRepository;
use App\Repository\DetailRepository;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class CommandeSubscriber implements EventSubscriber
{
    private $mailer;
    private $detailRepository;
    private $commandeRepository;

    public function __construct(MailerInterface $mailer, DetailRepository $detailRepository, CommandeRepository $commandeRepository)
    {
        $this->mailer = $mailer;
        $this->detailRepository = $detailRepository;
        $this->commandeRepository = $commandeRepository;
    }

    public function getSubscribedEvents()
    {
        return [
            Events::postPersist,
        ];
    }

    public function postPersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();
        $entity1 = $args->getObject();

        if ($entity instanceof \App\Entity\Detail) {
                // $user = $entity->getUtilisateur()->getEmail();
                // $date = $entity->getDateCommande();
                // $total = $entity->getTotal();
                // $id = $entity->getId();
                
                // $detail = $this->detailRepository->findBy(['commande' => $id]);
                // $detail = $this->detailRepository->findAll();
                // $message = 'Commande : ' . PHP_EOL;
                // foreach ($detail as $d) {
                //     if ($d->getCommande()->getId() == $id) {
                //         $quantite = $d->getQuantite();
                //         $libelle = $d->getPlat();

                //         $message .= $libelle . ' (Quantité : ' . $quantite . ')' . PHP_EOL;
                //     }
                // }
                // $detail = $entity->getDetails();

                // $quantite = $detail->getQuantite();
                // $plat = $detail->getPlat();

                $commandeID = $entity->getCommande()->getId();
                $commande = $this->commandeRepository->findAll();
                $detail = $this->detailRepository->findAll();
                foreach ($commande as $c) {
                    $coID = $c->getId();
                    if ($coID === $commandeID) {
                        $user = $c->getUtilisateur()->getEmail();
                        $date = $c->getDateCommande();
                        $total = $c->getTotal();
                        $nom = $c->getUtilisateur()->getNom();
                        $prenom = $c->getUtilisateur()->getPrenom();
                        $tel = $c->getUtilisateur()->getTelephone();
                        $adresse = $c->getUtilisateur()->getAdresse();
                        $cp = $c->getUtilisateur()->getCp();
                        $ville = $c->getUtilisateur()->getVille();
                    }
                }
                $message = 'Votre commande :' . PHP_EOL;
                foreach ($detail as $d) {
                    if ($commandeID === $d->getCommande()->getId()) {
                        $quantite = $d->getQuantite();
                        $libelle = $d->getPlat()->getLibelle();

                        $message .= $libelle . ' (Quantité : ' . $quantite . ')' . PHP_EOL; 
                    }
                }
                $message .= 'total : ' . $total . '€' . PHP_EOL . PHP_EOL;
                $message .= 'Adresse de livraison : ' . PHP_EOL;
                $message .= $nom . ' ' . $prenom . PHP_EOL;
                $message .= $tel . PHP_EOL;
                $message .= $adresse . PHP_EOL;
                $message .= $ville . PHP_EOL;
                $message .= $cp . PHP_EOL . PHP_EOL;
                $message .= 'À bientôt sur The District.';
                
                $email = (new Email())
                    ->from('commande@the_district.fr')
                    ->to($user)
                    ->subject('Commande du ' . $date->format('d/m/Y'))
                    ->text($message);

                $this->mailer->send($email);
        }
    }
}
