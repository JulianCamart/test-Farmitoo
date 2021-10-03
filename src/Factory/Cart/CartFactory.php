<?php

namespace App\Factory\Cart;

use App\Entity\Item;
use App\Entity\Order;
use App\Entity\Promotion;
use App\Factory\Fee\Fee;
use App\Factory\Fee\FeeFactory;
use Exception;

class CartFactory
{
    private FeeFactory $feesFactory;

    public function __construct(FeeFactory $feesFactory)
    {
        $this->feesFactory = $feesFactory;
    }

    /**
     * @throws Exception
     */
    public function createCart(Order $order, array $promotions = []): Cart
    {
        $cart = new Cart();

        $items = array_map(fn ($item) => clone $item, $order->getItems());

        $cart->setItems($items);
        $cart->setItemsCount(array_sum(array_map(fn(Item $item) => $item->getQuantity(), $items)));
        $cart->setItemsPrice(array_sum(array_map(fn(Item $item) => $item->getQuantity() * $item->getProduct()->getPrice(), $items)));

        $cart->setPromotions($this->computePromotions($promotions, $cart));

        $itemsByBrandId = $this->orderItemsByBrandId($cart->getItems());

        $cart->setDeliveringFees($this->getDeliveringFees($itemsByBrandId));
        $cart->setDeliveringFeesTotal($this->computeFeesTotal($cart->getDeliveringFees()));
        $cart->setPriceIncludeDeliveringFees(($cart->isFreeDeliveringFees() ? 0 : $cart->getDeliveringFeesTotal()) + ($cart->isHasValidPromotion() ? $cart->getItemsPriceAfterPromotion() : $cart->getItemsPrice()));

        $cart->setVatFees($this->getVatFees($itemsByBrandId));
        $cart->setVatFeesTotal($this->computeFeesTotal($cart->getVatFees()));
        $cart->setPriceIncludeVatFees($cart->getVatFeesTotal() + $cart->getPriceIncludeDeliveringFees());

        return $cart;
    }

    protected function orderItemsByBrandId(array $items): array
    {
        return array_reduce($items, function ($carry, Item $item) {
            $brandId = $item->getProduct()->getBrand()->getId();
            $carry[$brandId] = array_merge(
                $carry[$brandId] ?? [],
                [$item]
            );
            return $carry;
        }, []);
    }

    protected function computePromotions(array $promotions, Cart $cart): array
    {
        usort($promotions,
            function(Promotion $promotionA, Promotion $promotionB) {
                if ($promotionB->getReduction() == $promotionA->getReduction()) {
                    return 0;
                }
                return $promotionB->getReduction() < $promotionA->getReduction() ? 1 : -1;
            }
        );

        /** @var Promotion $promotion */
        foreach ($promotions as $promotion) {
            if ($promotion->getMinAmount() < $cart->getItemsPrice()) {
                $promotion->setIsActive(true);
                $cart->setHasValidPromotion(true);
                if($promotion->isFreeDelivery()) {
                    $cart->setFreeDeliveringFees(true);
                }
                if($promotion->getReduction()) {

                    $promotionAmount = 0;
                    /** @var Item $item */
                    foreach ($cart->getItems() as $item) {
                        $oldPrice = $item->getTotalPriceAfterPromotion() ?? $item->getTotalPrice();
                        $item->setTotalPriceAfterPromotion($oldPrice - ($oldPrice * ($promotion->getReduction() / 100)));

                        $promotionAmount = $promotionAmount + ($oldPrice - $item->getTotalPriceAfterPromotion());

                    }

                    $promotion->setAmount($promotionAmount);
                }
            }
        }

        if($priceAfterPromotion = array_sum(array_map(fn(Item $item) => $item->getTotalPriceAfterPromotion(), $cart->getItems()))) {
            $cart->setItemsPriceAfterPromotion($priceAfterPromotion);
        }

        return $promotions;
    }

    /**
     * @throws Exception
     */
    protected function getDeliveringFees(array $itemsByBrandId): array
    {
        $deliveringFees = [];
        foreach ($itemsByBrandId as $items) {
            $deliveringFees[] = $this->feesFactory->createDelivery($items);
        }
        return $deliveringFees;
    }

    /**
     * @throws Exception
     */
    protected function getVatFees(array $itemsByBrandId): array
    {
        $vatFees = [];
        foreach ($itemsByBrandId as $items) {
            $vatFees[] = $this->feesFactory->createVat($items);
        }
        return $vatFees;
    }

    protected function computeFeesTotal(array $fees): float
    {
        return array_sum(array_map(fn(Fee $fee) => $fee->getCost(), $fees));
    }

}