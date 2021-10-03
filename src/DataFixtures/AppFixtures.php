<?php

namespace App\DataFixtures;

use App\Entity\Brand;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    private const BRANDS = [
        [
            'title' => 'Farmitoo',
            'average_price' => 20
        ],
        [
            'title' => 'Gallagher',
            'average_price' => 15
        ],
        [
            'title' => 'Ligapal',
            'average_price' => 10
        ],
        [
            'title' => 'Morellat',
            'average_price' => 5
        ],
        [
            'title' => 'Greisinger',
            'average_price' => 0
        ],
        [
            'title' => 'Kamer',
            'average_price' => -5
        ],
        [
            'title' => 'Airpress',
            'average_price' => -10
        ],
        [
            'title' => 'Compa',
            'average_price' => -15
        ],
        [
            'title' => 'Kraftwerk',
            'average_price' => -20
        ],
        [
            'title' => 'Mecafer',
            'average_price' => 25
        ],
        [
            'title' => 'Cemo',
            'average_price' => 8
        ],
        [
            'title' => 'Velamp',
            'average_price' => 14
        ],
        [
            'title' => 'Ama',
            'average_price' => 3
        ],
    ];

    private const PRODUCTS = [
        [
            'title' => 'Cuve à gasoil',
            'image' => 'cuve_a_gasoil.jpg',
            'price' => 4000,
        ],
        [
            'title' => 'Nettoyant pour cuve',
            'image' => 'nettoyan_cuve.png',
            'price' => 408,
        ],
        [
            'title' => 'Piquet de clôture',
            'image' => 'piquet_cloture.jpg',
            'price' => 11,
        ],
        [
            'title' => 'Boite a outils noire',
            'image' => 'boite_a_outil.jpg',
            'price' => 101,
        ],
        [
            'title' => 'pince multiprise',
            'image' => 'pince_multiprise.jpg',
            'price' => 28.99,
        ],
        [
            'title' => 'Repulsif à oiseaux universel',
            'image' => 'repulsif_oiseau.png',
            'price' => 638,
        ],
        [
            'title' => 'Regulateur pour canon a gaz',
            'image' => 'regulateur_gaz.jpg',
            'price' => 42,
        ],
        [
            'title' => 'Tripode rotatif pour effaroucher',
            'image' => 'tripode_rotatif.jpg',
            'price' => 88,
        ],
        [
            'title' => 'Cisaille à gazon',
            'image' => 'cisaille_gazon.jpg',
            'price' => 45,
        ],
        [
            'title' => 'Sécateur pneumatique',
            'image' => 'secateur_pneumatique.jpeg',
            'price' => 119,
        ],
        [
            'title' => 'Râteau à gazon',
            'image' => 'rateau_gazon.jpg',
            'price' => 23,
        ],
        [
            'title' => 'Désherbeur',
            'image' => 'deserbeur.jpg',
            'price' => 14,
        ],
        [
            'title' => 'Fongicide toiture-terrasse',
            'image' => 'fongicide.png',
            'price' => 209,
        ],
    ];

    public function load(ObjectManager $manager)
    {
        $products = $this->getProducts($manager);

        foreach ($products as $product) {
            $manager->persist($product);
        }

        $manager->flush();
    }

    private function getProducts(ObjectManager $manager): array
    {
        $products = [];
        $productsCount = count(self::PRODUCTS);
        foreach (self::BRANDS as $brand) {
            $newBrand = new Brand($brand['title']);
            $averagePrice = $brand['average_price'];
            $manager->persist($newBrand);
            $i = rand(2, 5);
            for($j = 0; $j !== $i; $j++) {
                $product = self::PRODUCTS[rand(0, $productsCount - 1)];
                $products[] = new Product($product['title'], $this->getPrice($averagePrice, $product['price']), $product['image'], $newBrand);

            }
        }
        return array_unique($products, SORT_REGULAR);
    }

    private function getPrice($averagePrice, $price): float
    {
        return  ($averagePrice / 100) * $price + $price;
    }
}
