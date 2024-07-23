<?php

namespace App\Controller;

use App\Entity\Slide;
use App\Form\Slide1Type;
use App\Repository\SlideRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SlideController extends AbstractController
{
    #[Route('/', name: 'app_slide_index', methods: ['GET'])]
    public function index(SlideRepository $slideRepository): Response
    {
        return $this->render('home/partials/hero.html.twig', [
            'url' => 'service',
            'data' => $slideRepository->findAll()
        ]);
    }
}
