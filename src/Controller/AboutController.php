<?php

namespace App\Controller;

use App\Repository\ClientRepository;
use App\Repository\TestimonialRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AboutController extends AbstractController
{
    /**
     * @Route("/about-us", name="app_about")
     */
    public function about(ClientRepository $clientRepository, TestimonialRepository $testimonialRepository): Response
    {
        return $this->render('about/index.html.twig', [
            'url' => 'about-us',
            'customers' => $clientRepository->findAll(),
            'testimonials' => $testimonialRepository->findAll()
        ]);
    }

    /**
     * @Route("/contact-us", name="app_contact_us")
     */
    public function index(Request $request): Response
    {

        return $this->render('about/contact-us.html.twig', [
            'url' => 'contact-us',
        ]);
    }
}
