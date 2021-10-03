<?php

namespace App\Factory\Cart;

class Cart
{
    protected array $items;
    protected int $itemsCount;
    protected float $itemsPrice;
    protected bool $hasValidPromotion = false;
    protected ?float $itemsPriceAfterPromotion = null;
    protected bool $freeDeliveringFees = false;
    protected array $promotions;
    protected array $deliveringFees;
    protected float $deliveringFeesTotal;
    protected float $priceIncludeDeliveringFees;
    protected array $vatFees;
    protected float $vatFeesTotal;
    protected float $priceIncludeVatFees;

    public function getItems(): array
    {
        return $this->items;
    }

    public function setItems(array $items): void
    {
        $this->items = $items;
    }

    public function getItemsCount(): int
    {
        return $this->itemsCount;
    }

    public function setItemsCount(int $itemsCount): void
    {
        $this->itemsCount = $itemsCount;
    }

    public function getItemsPrice(): float
    {
        return $this->itemsPrice;
    }

    public function setItemsPrice(float $itemsPrice): void
    {
        $this->itemsPrice = $itemsPrice;
    }

    public function isHasValidPromotion(): bool
    {
        return $this->hasValidPromotion;
    }

    public function setHasValidPromotion(bool $hasValidPromotion): void
    {
        $this->hasValidPromotion = $hasValidPromotion;
    }

    public function getItemsPriceAfterPromotion(): ?float
    {
        return $this->itemsPriceAfterPromotion;
    }

    public function setItemsPriceAfterPromotion(?float $itemsPriceAfterPromotion): void
    {
        $this->itemsPriceAfterPromotion = $itemsPriceAfterPromotion;
    }

    public function getPromotions(): array
    {
        return $this->promotions;
    }

    public function setPromotions(array $promotions): void
    {
        $this->promotions = $promotions;
    }

    public function isFreeDeliveringFees(): bool
    {
        return $this->freeDeliveringFees;
    }

    public function setFreeDeliveringFees(bool $freeDeliveringFees): void
    {
        $this->freeDeliveringFees = $freeDeliveringFees;
    }

    public function getDeliveringFees(): array
    {
        return $this->deliveringFees;
    }

    public function setDeliveringFees(array $deliveringFees): void
    {
        $this->deliveringFees = $deliveringFees;
    }

    public function getDeliveringFeesTotal(): float
    {
        return $this->deliveringFeesTotal;
    }

    public function setDeliveringFeesTotal(float $deliveringFeesTotal): void
    {
        $this->deliveringFeesTotal = $deliveringFeesTotal;
    }

    public function getPriceIncludeDeliveringFees(): float
    {
        return $this->priceIncludeDeliveringFees;
    }

    public function setPriceIncludeDeliveringFees(float $priceIncludeDeliveringFees): void
    {
        $this->priceIncludeDeliveringFees = $priceIncludeDeliveringFees;
    }

    public function getVatFees(): array
    {
        return $this->vatFees;
    }

    public function setVatFees(array $vatFees): void
    {
        $this->vatFees = $vatFees;
    }

    public function getVatFeesTotal(): float
    {
        return $this->vatFeesTotal;
    }

    public function setVatFeesTotal(float $vatFeesTotal): void
    {
        $this->vatFeesTotal = $vatFeesTotal;
    }

    public function getPriceIncludeVatFees(): float
    {
        return $this->priceIncludeVatFees;
    }

    public function setPriceIncludeVatFees(float $priceIncludeVatFees): void
    {
        $this->priceIncludeVatFees = $priceIncludeVatFees;
    }
}