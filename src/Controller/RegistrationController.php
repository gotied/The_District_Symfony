<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\RegistrationFormType;
use App\Security\TheDistrictAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;
use DateTime;
use Symfony\Contracts\Translation\TranslatorInterface;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, UserAuthenticatorInterface $userAuthenticator, TheDistrictAuthenticator $authenticator, EntityManagerInterface $entityManager, MailerInterface $mailer): Response
    {
        $user = new Utilisateur();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $form->get('plainPassword')->getData(),
                $userPasswordHasher
            );

            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            $expediteur = 'inscription@the_district.fr';
            $clientEmail = $user->getEmail();
            $clientSubject = 'Bienvenue sur The District';
            $clientMessage = 'Merci de vous être inscrit sur The District !';

            $email = (new Email())
                ->from($expediteur)
                ->to($clientEmail)
                ->subject($clientSubject)
                ->text($clientMessage);

            $mailer->send($email);

            $gerantEmail = 'admin@the_district.fr';
            $gerantSubjet = 'Nouvelle inscription - Récapitulatif';
            $gerantMessage = "Une nouvelle inscription a été enregistrée sur The District." . PHP_EOL . PHP_EOL;
            $gerantMessage .= "Informations de l'utilisateur :" . PHP_EOL;
            $gerantMessage .= 'Adresse e-mail : ' . $user->getEmail() . PHP_EOL;
            $date = new DateTime();
            $gerantMessage .= 'Date d\'inscription : ' . $date->format('d/m/Y H:i:s');

            $email = (new Email())
                ->from($expediteur)
                ->to($gerantEmail)
                ->subject($gerantSubjet)
                ->text($gerantMessage);

            $mailer->send($email);

            return $userAuthenticator->authenticateUser(
                $user,
                $authenticator,
                $request
            );
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
