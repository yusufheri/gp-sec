<?php

namespace App\Controller\Dashboard;

use App\Repository\ClientRepository;
use App\Repository\DevisRepository;
use App\Repository\NewsRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/dashboard", name="app_dashboard_home")
     */
    public function index(
        DevisRepository $devisRepository,
        ProductRepository $productRepository,
        NewsRepository $newsRepository,
        ClientRepository $clientRepository
    ): Response {
        return $this->render('dashboard/home/index.html.twig', [
            'count_devis' => $devisRepository->count([]),
            'count_products' => $productRepository->count([]),
            'count_news' => $newsRepository->count([]),
            'count_clients' => $clientRepository->count([]),
        ]);
    }
}
