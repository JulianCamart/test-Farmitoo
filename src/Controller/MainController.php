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
        //$promotion1 = new Promotion(50000, 8, false);

        // Je passe une commande avec
        // Cuve à gasoil x1
        // Nettoyant pour cuve x3
        // Piquet de clôture x5

        return $this->render('base.html.twig', [
        ]);
    }
}
