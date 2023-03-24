<?php

namespace App\Controller\Dashboard;

use App\Entity\ImageProduct;
use App\Form\ImageProductType;
use App\Repository\ImageProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/dashboard/image/product")
 */
class ImageProductController extends AbstractController
{
    /**
     * @Route("/", name="app_dashboard_image_product_index", methods={"GET"})
     */
    public function index(ImageProductRepository $imageProductRepository): Response
    {
        return $this->render('dashboard/image_product/index.html.twig', [
            'image_products' => $imageProductRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_dashboard_image_product_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ImageProductRepository $imageProductRepository): Response
    {
        $imageProduct = new ImageProduct();
        $form = $this->createForm(ImageProductType::class, $imageProduct);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageProductRepository->add($imageProduct, true);

            return $this->redirectToRoute('app_dashboard_image_product_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('dashboard/image_product/new.html.twig', [
            'image_product' => $imageProduct,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_dashboard_image_product_show", methods={"GET"})
     */
    public function show(ImageProduct $imageProduct): Response
    {
        return $this->render('dashboard/image_product/show.html.twig', [
            'image_product' => $imageProduct,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_dashboard_image_product_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, ImageProduct $imageProduct, ImageProductRepository $imageProductRepository): Response
    {
        $form = $this->createForm(ImageProductType::class, $imageProduct);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageProductRepository->add($imageProduct, true);

            return $this->redirectToRoute('app_dashboard_image_product_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('dashboard/image_product/edit.html.twig', [
            'image_product' => $imageProduct,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_dashboard_image_product_delete", methods={"POST"})
     */
    public function delete(Request $request, ImageProduct $imageProduct, ImageProductRepository $imageProductRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$imageProduct->getId(), $request->request->get('_token'))) {
            $imageProductRepository->remove($imageProduct, true);
        }

        return $this->redirectToRoute('app_dashboard_image_product_index', [], Response::HTTP_SEE_OTHER);
    }
}
