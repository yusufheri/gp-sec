<?php

namespace App\Controller\Dashboard;

use App\Entity\Slide;
use App\Form\SlideType;
use App\Repository\SlideRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/dashboard/slide")
 */
class SlideController extends AbstractController
{
    /**
     * @Route("/", name="app_dashboard_slide_index", methods={"GET"})
     */
    public function index(SlideRepository $slideRepository): Response
    {
        return $this->render('dashboard/slide/index.html.twig', [
            'slides' => $slideRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_dashboard_slide_new", methods={"GET", "POST"})
     */
    public function new(Request $request, SlideRepository $slideRepository): Response
    {
        $slide = new Slide();
        $form = $this->createForm(SlideType::class, $slide);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $slideRepository->add($slide, true);

            return $this->redirectToRoute('app_dashboard_slide_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('dashboard/slide/new.html.twig', [
            'slide' => $slide,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_dashboard_slide_show", methods={"GET"})
     */
    public function show(Slide $slide): Response
    {
        return $this->render('dashboard/slide/show.html.twig', [
            'slide' => $slide,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_dashboard_slide_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Slide $slide, SlideRepository $slideRepository): Response
    {
        $form = $this->createForm(SlideType::class, $slide);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $slideRepository->add($slide, true);

            return $this->redirectToRoute('app_dashboard_slide_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('dashboard/slide/edit.html.twig', [
            'slide' => $slide,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_dashboard_slide_delete", methods={"POST"})
     */
    public function delete(Request $request, Slide $slide, SlideRepository $slideRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$slide->getId(), $request->request->get('_token'))) {
            $slideRepository->remove($slide, true);
        }

        return $this->redirectToRoute('app_dashboard_slide_index', [], Response::HTTP_SEE_OTHER);
    }
}
