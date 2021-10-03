<?php

namespace App\Controller;

use App\Entity\Item;
use App\Entity\Order;
use App\Entity\Product;
use App\Factory\Cart\CartFactory;
use App\Factory\Promotion\PromotionFactory;
use App\Repository\ProductRepository;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route(name="index", path="/", methods={"GET"})
     */
    public function index(ProductRepository $productRepository, SessionInterface $session): Response
    {
        $products = $productRepository->findAll();

        return $this->render('pages/index.html.twig', [
            'order' => $session->get('order', new Order([])),
            'products' => $products,
        ]);
    }

    /**
     * @Route(name="cart_add_product", path="/cart/add/{product}", methods={"POST"})
     */
    public function cartAddProduct(Product $product, Request $request, SessionInterface $session): Response
    {
        try {
            $quantity = json_decode($request->getContent())->quantity;
        } catch (Exception $e) {
            throw new BadRequestException($e->getMessage());
        }

        /** @var Order $order */
        $order = $session->get('order', new Order([]));
        $order->setItems(array_merge(array_filter($order->getItems(),fn(Item $item) => $item->getProduct()->getId() !== $product->getId()), $quantity > 0 ? [new Item($product, $quantity)] : [] ));
        $session->set('order', $order);

        return new Response();
    }

    /**
     * @Route(name="cart", path="/cart", methods={"GET"})
     * @throws Exception
     */
    public function cart(Request $request, SessionInterface $session, CartFactory $cartFactory, PromotionFactory $promotionFactory): Response
    {

        $order = $session->get('order', new Order([]));

        if(!empty($promotions = $request->get('promotions', []))) {
            $promotions = array_map(fn($promotionId) => $promotionFactory->getPromotions()[$promotionId], $promotions);
        }

        $cart = $cartFactory->createCart($order, $promotions);

        return $this->render('pages/cart.html.twig', [
            'cart' => $cart
        ]);
    }
}
