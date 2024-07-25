<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\Product1Type;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("product_prod")
 */
class ProductController extends AbstractController
{
    /**
     * @Route("/", name="app_product")
     */
    public function index(ProductRepository $productRepository): Response
    {
        return $this->render('product/index.html.twig', [
            'url' => 'product',
            'data' => $productRepository->findAll()
        ]);
    }

    /*
    #[Route('/our-products', name: 'app_product', methods: ['GET'])]
    public function index(ProductRepository $productRepository): Response
    {
        return $this->render('product/index.html.twig', [
            'products' => $productRepository->findAll(),
        ]);
    }*/

    /**
     * @Route("/{id}", name="app_product_show")
     */
    public function show(Product $product): Response
    {
        return $this->render('product/show.html.twig', [
            'product' => $product,
        ]);
    }
}