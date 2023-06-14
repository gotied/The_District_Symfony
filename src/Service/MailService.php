<?php
namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class MailService
{
    private $mailer;
    private $paramBag;
    //On injecte dans le constructeur le MailerInterface

    public function __construct(MailerInterface $mailer, ParameterBagInterface $paramBag){
        $this->mailer = $mailer;
        $this->paramBag = $paramBag;
    }

    public function sendMail(MailerInterface $mailer, $expediteur, $destinataire, $sujet, $message){
        $email = (new TemplatedEmail())
            ->from($expediteur)
            ->to($destinataire)
            ->subject($sujet)
            ->text($message);
            $mailer->send($email);
    }
    //On se sert du parameterBag et du nom du paramètre ('image_directory') pour récupèrer le chemin du dossier "images"
    //$dossiers_images = $this->paramBag->get('images_directory');
    //...

}