<?php

namespace App\Controller\Dashboard;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/dashboard/product")
 */
class ProductController extends AbstractController
{
    /**
     * @Route("/", name="app_dashboard_product_index", methods={"GET"})
     */
    public function index(ProductRepository $productRepository): Response
    {
        return $this->render('dashboard/product/index.html.twig', [
            'products' => $productRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_dashboard_product_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ProductRepository $productRepository): Response
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $picture = $form->get('picture')->getData();
            $folder = $this->getParameter('profile.folder');
            $ext = $picture->guessExtension();
            $filename = bin2hex(random_bytes(10)) . '.' . $ext;
            $picture->move($folder, $filename);
            $product->setPicture($this->getParameter('profile.folder.public_path') . '' . $filename);
            $productRepository->add($product, true);

            return $this->redirectToRoute('app_dashboard_product_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('dashboard/product/new.html.twig', [
            'product' => $product,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_dashboard_product_show", methods={"GET"})
     */
    public function show(Product $product): Response
    {
        return $this->render('dashboard/product/show.html.twig', [
            'product' => $product,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_dashboard_product_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Product $product, ProductRepository $productRepository): Response
    {
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $productRepository->add($product, true);

            return $this->redirectToRoute('app_dashboard_product_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('dashboard/product/edit.html.twig', [
            'product' => $product,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_dashboard_product_delete", methods={"POST"})
     */
    public function delete(Request $request, Product $product, ProductRepository $productRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $product->getId(), $request->request->get('_token'))) {
            $productRepository->remove($product, true);
        }

        return $this->redirectToRoute('app_dashboard_product_index', [], Response::HTTP_SEE_OTHER);
    }
}
