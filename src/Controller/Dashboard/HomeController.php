<?php

namespace App\Controller\Dashboard;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/dashboard", name="app_dashboard_home")
     */
    public function index(): Response
    {
        return $this->render('dashboard/home/index.html.twig', [
            'controller_name' => 'HomeController'
        ]);
    }
}
