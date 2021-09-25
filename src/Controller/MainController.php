<?php

namespace App\Controller;

use App\Entity\Brand;
use App\Entity\Item;
use App\Entity\Product;
use App\Entity\Promotion;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route(name="index", path="/")
     */
    public function index()
    {
        $brand1 = new Brand('Farmitoo');
        $brand2 = new Brand('Gallagher');

        $product1 = new Product('Cuve à gasoil', 250000, $brand1);
        $product2 = new Product('Nettoyant pour cuve', 5000, $brand1);
        $product3 = new Product('Piquet de clôture', 1000, $brand2);

        $promotion1 = new Promotion(50000, 8, false);

        $item1 = new Item($product1, 1);
        $item2 = new Item($product2, 3);
        $item3 = new Item($product3, 5);

        // Je passe une commande avec
        // Cuve à gasoil x1
        // Nettoyant pour cuve x3
        // Piquet de clôture x5

        return $this->render('base.html.twig', [
        ]);
    }
}
