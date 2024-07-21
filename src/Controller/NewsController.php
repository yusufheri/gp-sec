<?php

namespace App\Controller;

use App\Entity\News;
use App\Repository\CategoryNewsRepository;
use App\Repository\NewsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NewsController extends AbstractController
{
    /**
     * @Route("/our-news", name="app_news")
     */
    public function index(NewsRepository $newsRepository, CategoryNewsRepository $categoryNewsRepository): Response
    {
        return $this->render('news/index.html.twig', [
            'url' => 'news',
            'data' => $newsRepository->findBy([], ["publiedAt" => "DESC"]),
            'categories' => $categoryNewsRepository->findBy([], ["name" => "ASC"]),
            'lastNews' => $newsRepository->findBy([], ["publiedAt" => "DESC"], 3),
        ]);
    }
    #[Route('/our-news/{id}', name: 'app_news_show', methods: ['GET'])]
    public function show(News $news): Response
    {
        return $this->render('service/show.html.twig', [
            'news' => $news,
        ]);
    }
}