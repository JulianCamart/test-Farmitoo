<?php


namespace App\Entity;


class Item
{
    protected Product $product;

    protected int $quantity;

    protected float $totalPrice;

    protected ?float $totalPriceAfterPromotion = null;

    public function __construct(Product $product, int $quantity)
    {
        $this->product = $product;
        $this->quantity = $quantity;
        $this->totalPrice = $product->getPrice() * $quantity;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getTotalPrice(): float
    {
        return $this->totalPrice;
    }

    public function getTotalPriceAfterPromotion(): ?float
    {
        return $this->totalPriceAfterPromotion;
    }

    public function setTotalPriceAfterPromotion(?float $totalPriceAfterPromotion): void
    {
        $this->totalPriceAfterPromotion = $totalPriceAfterPromotion;
    }
}
