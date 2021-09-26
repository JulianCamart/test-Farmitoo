<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route(name="index", path="/")
     */
    public function index(ProductRepository $productRepository)
    {
        $products = $productRepository->findBy([], ['title' => 'ASC']);

        //$promotion1 = new Promotion(50000, 8, false);

        // Je passe une commande avec
        // Cuve à gasoil x1
        // Nettoyant pour cuve x3
        // Piquet de clôture x5

        return $this->render('index/index.html.twig', [
            'products' => $products,
        ]);
    }
}
