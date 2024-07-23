<?php

namespace App\Controller;

use App\Entity\Partner;
use App\Repository\PartnerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PartnerController extends AbstractController
{
    /**
     * @Route("/our-partner", name="app_partner")
     */
    public function index(PartnerRepository $partnerRepository): Response
    {
        return $this->render('partner/index.html.twig', [
            'url' => 'partner',
            'data' => $partnerRepository->findAll()
        ]);
    }
    /**
     * @Route("/our-partner_all", name="app_partner_all")
     */
    public function all(PartnerRepository $partnerRepository): Response
    {
        return $this->render('partner/index.html.twig', [
            'p' => $partnerRepository->findAll()
        ]);
    }
}
