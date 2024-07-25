<?php

namespace App\Controller;

use App\Entity\Service;
use App\Repository\ServiceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("services_serv")
 */
class ServiceController extends AbstractController
{
    /**
     * @Route("/", name="app_service")
     */
    public function index(ServiceRepository $serviceRepository): Response
    {
        return $this->render('service/index.html.twig', [
            'url' => 'service',
            'data' => $serviceRepository->findAll()
        ]);
    }
}