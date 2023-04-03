<?php

namespace App\Controller\Customer;

use App\Entity\Devis;
use App\Form\DevisType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DevisController extends AbstractController
{
    /**
     * @Route("/customer/nous-contacter-pour-un-devis", name="app_customer_devis")
     */
    public function index(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        $devis = new Devis();

        $form = $this->createForm(DevisType::class, $devis);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $devis->setCreatedAt(new \DateTimeImmutable());
            $entityManagerInterface->persist($devis);
            $entityManagerInterface->flush();

            $this->addFlash('success', 'Votre message a été envoyé avec succès. Un expert vous contactera dans un bref délai.');
            return $this->redirectToRoute('app_contact_us');
        }

        return $this->render('customer/devis/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
