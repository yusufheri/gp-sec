<?php

namespace App\Controller\Dashboard;

use App\Entity\Testimonial;
use App\Form\TestimonialType;
use App\Repository\TestimonialRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/dashboard/testimonial")
 */
class TestimonialController extends AbstractController
{
    /**
     * @Route("/", name="app_dashboard_testimonial_index", methods={"GET"})
     */
    public function index(TestimonialRepository $testimonialRepository): Response
    {
        return $this->render('dashboard/testimonial/index.html.twig', [
            'testimonials' => $testimonialRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_dashboard_testimonial_new", methods={"GET", "POST"})
     */
    public function new(Request $request, TestimonialRepository $testimonialRepository): Response
    {
        $testimonial = new Testimonial();
        $form = $this->createForm(TestimonialType::class, $testimonial);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $testimonialRepository->add($testimonial, true);

            return $this->redirectToRoute('app_dashboard_testimonial_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('dashboard/testimonial/new.html.twig', [
            'testimonial' => $testimonial,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_dashboard_testimonial_show", methods={"GET"})
     */
    public function show(Testimonial $testimonial): Response
    {
        return $this->render('dashboard/testimonial/show.html.twig', [
            'testimonial' => $testimonial,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_dashboard_testimonial_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Testimonial $testimonial, TestimonialRepository $testimonialRepository): Response
    {
        $form = $this->createForm(TestimonialType::class, $testimonial);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $testimonialRepository->add($testimonial, true);

            return $this->redirectToRoute('app_dashboard_testimonial_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('dashboard/testimonial/edit.html.twig', [
            'testimonial' => $testimonial,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_dashboard_testimonial_delete", methods={"POST"})
     */
    public function delete(Request $request, Testimonial $testimonial, TestimonialRepository $testimonialRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$testimonial->getId(), $request->request->get('_token'))) {
            $testimonialRepository->remove($testimonial, true);
        }

        return $this->redirectToRoute('app_dashboard_testimonial_index', [], Response::HTTP_SEE_OTHER);
    }
}
