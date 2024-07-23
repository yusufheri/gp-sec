<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/send-us-a-message", name="app_contact")
     */
    public function index(Request $request, MailerInterface $mailer, EntityManagerInterface $entityManagerInterface): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $contact->setCreatedAt(new \DateTimeImmutable());
                $entityManagerInterface->persist($contact);
                $entityManagerInterface->flush();

                $email = (new Email())
                    ->from($contact->getEmail())
                    ->to('administration@gp-sec.com')
                    ->subject($contact->getName() . ' : ' . $contact->getSubject())
                    ->text($contact->getMessage());

                $mailer->send($email);


                $this->addFlash('success', '<h2>Votre message a été envoyé avec succès !😎😊</h2>');
                return $this->redirectToRoute('app_contact_us');
            } else {
                $this->addFlash('danger', '<h2>Les données soumises ne sont pas valides 😔!!</h2> <br> Prière de complèter tous les champs du formulaire');
                return $this->redirectToRoute('app_contact_us');
            }
        }

        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
