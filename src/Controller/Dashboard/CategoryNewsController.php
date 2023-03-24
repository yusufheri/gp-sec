<?php

namespace App\Controller\Dashboard;

use App\Entity\CategoryNews;
use App\Form\CategoryNewsType;
use App\Repository\CategoryNewsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/dashboard/category-news")
 */
class CategoryNewsController extends AbstractController
{
    /**
     * @Route("/", name="app_dashboard_category_news_index", methods={"GET"})
     */
    public function index(CategoryNewsRepository $categoryNewsRepository): Response
    {
        return $this->render('dashboard/category_news/index.html.twig', [
            'category_news' => $categoryNewsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_dashboard_category_news_new", methods={"GET", "POST"})
     */
    public function new(Request $request, CategoryNewsRepository $categoryNewsRepository): Response
    {
        $categoryNews = new CategoryNews();
        $form = $this->createForm(CategoryNewsType::class, $categoryNews);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $categoryNewsRepository->add($categoryNews, true);

            return $this->redirectToRoute('app_dashboard_category_news_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('dashboard/category_news/new.html.twig', [
            'category_news' => $categoryNews,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_dashboard_category_news_show", methods={"GET"})
     */
    public function show(CategoryNews $categoryNews): Response
    {
        return $this->render('dashboard/category_news/show.html.twig', [
            'category_news' => $categoryNews,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_dashboard_category_news_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, CategoryNews $categoryNews, CategoryNewsRepository $categoryNewsRepository): Response
    {
        $form = $this->createForm(CategoryNewsType::class, $categoryNews);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $categoryNewsRepository->add($categoryNews, true);

            return $this->redirectToRoute('app_dashboard_category_news_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('dashboard/category_news/edit.html.twig', [
            'category_news' => $categoryNews,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_dashboard_category_news_delete", methods={"POST"})
     */
    public function delete(Request $request, CategoryNews $categoryNews, CategoryNewsRepository $categoryNewsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $categoryNews->getId(), $request->request->get('_token'))) {
            $categoryNewsRepository->remove($categoryNews, true);
        }

        return $this->redirectToRoute('app_dashboard_category_news_index', [], Response::HTTP_SEE_OTHER);
    }
}
