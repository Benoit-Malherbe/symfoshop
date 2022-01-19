<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/nos-produits', name: 'products')]
    public function browse(ProductRepository $productRepository): Response
    {
        $products = $productRepository->findAll();
        
        return $this->render('product/browse.html.twig', [
            'products' => $products
        ]);
    }

    #[Route('/produit/{slug}', name: 'product')]
    public function read(ProductRepository $productRepository, $slug): Response
    {
        $product = $productRepository->findOneBySlug($slug);
        
        if (!$product) {
            return $this->redirectToRoute('products');
        }

        return $this->render('product/read.html.twig', [
            'product' => $product
        ]);
    }
}
