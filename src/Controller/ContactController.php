<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use App\Service\MailService;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, EntityManagerInterface $entityManager, MailerInterface $mailer, MailService $ms): Response
    {
        $form = $this->createForm(ContactFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            //on crée une instance de Contact
            $message = new Contact();
            // Traitement des données du formulaire
            $data = $form->getData();
            //on stocke les données récupérées dans la variable $message
            $message = $data;

            // $email = (new TemplatedEmail())
            // ->from('admin@the_district.fr')
            // ->to(new Address($data->getEmail()))
            // ->subject($data->getObjet())
            // ->text($data->getMessage());
            // $mailer->send($email);

            $expediteur = $message->getEmail();
            $destinataire = 'admin@the_district.fr';
            $sujet = $message->getObjet();
            $message = $message->getMessage();

            $email = $ms->sendMail($mailer, $expediteur, $destinataire, $sujet, $message);


            // $entityManager->persist($message);
            // $entityManager->flush();



            // Redirection vers accueil
            return $this->redirectToRoute('app_accueil');
        }
        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
            'form' => $form
        ]);
    }
}
