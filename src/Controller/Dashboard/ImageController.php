<?php

namespace App\Controller\Dashboard;

use App\Entity\Image;
use App\Form\ImageType;
use App\Repository\ImageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/dashboard/image")
 */
class ImageController extends AbstractController
{
    /**
     * @Route("/", name="app_dashboard_image_index", methods={"GET"})
     */
    public function index(ImageRepository $imageRepository): Response
    {
        return $this->render('dashboard/image/index.html.twig', [
            'images' => $imageRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_dashboard_image_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ImageRepository $imageRepository): Response
    {
        $image = new Image();
        $form = $this->createForm(ImageType::class, $image);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageRepository->add($image, true);

            return $this->redirectToRoute('app_dashboard_image_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('dashboard/image/new.html.twig', [
            'image' => $image,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_dashboard_image_show", methods={"GET"})
     */
    public function show(Image $image): Response
    {
        return $this->render('dashboard/image/show.html.twig', [
            'image' => $image,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_dashboard_image_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Image $image, ImageRepository $imageRepository): Response
    {
        $form = $this->createForm(ImageType::class, $image);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageRepository->add($image, true);

            return $this->redirectToRoute('app_dashboard_image_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('dashboard/image/edit.html.twig', [
            'image' => $image,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_dashboard_image_delete", methods={"POST"})
     */
    public function delete(Request $request, Image $image, ImageRepository $imageRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$image->getId(), $request->request->get('_token'))) {
            $imageRepository->remove($image, true);
        }

        return $this->redirectToRoute('app_dashboard_image_index', [], Response::HTTP_SEE_OTHER);
    }
}
