<?php

namespace App\Controller\Dashboard;

use App\Entity\About;
use App\Form\AboutType;
use App\Repository\AboutRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/dashboard/about")
 */
class AboutController extends AbstractController
{
    /**
     * @Route("/", name="app_dashboard_about_index", methods={"GET"})
     */
    public function index(AboutRepository $aboutRepository): Response
    {
        return $this->render('dashboard/about/index.html.twig', [
            'abouts' => $aboutRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_dashboard_about_new", methods={"GET", "POST"})
     */
    public function new(Request $request, AboutRepository $aboutRepository): Response
    {
        $about = new About();
        $form = $this->createForm(AboutType::class, $about);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $aboutRepository->add($about, true);

            return $this->redirectToRoute('app_dashboard_about_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('dashboard/about/new.html.twig', [
            'about' => $about,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_dashboard_about_show", methods={"GET"})
     */
    public function show(About $about): Response
    {
        return $this->render('dashboard/about/show.html.twig', [
            'about' => $about,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_dashboard_about_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, About $about, AboutRepository $aboutRepository): Response
    {
        $form = $this->createForm(AboutType::class, $about);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $aboutRepository->add($about, true);

            return $this->redirectToRoute('app_dashboard_about_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('dashboard/about/edit.html.twig', [
            'about' => $about,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_dashboard_about_delete", methods={"POST"})
     */
    public function delete(Request $request, About $about, AboutRepository $aboutRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$about->getId(), $request->request->get('_token'))) {
            $aboutRepository->remove($about, true);
        }

        return $this->redirectToRoute('app_dashboard_about_index', [], Response::HTTP_SEE_OTHER);
    }
}
