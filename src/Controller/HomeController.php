<?php

namespace App\Controller;

use App\Service\Homepage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function index(Homepage $homepage): Response
    {
        return $this->render('home/index.html.twig', [
            'data' => $homepage,
            'url' => 'homepage'
        ]);
    }
}
