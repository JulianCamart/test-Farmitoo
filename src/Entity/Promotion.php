<?php


namespace App\Entity;


class Promotion
{
    protected int $minAmount;

    protected int $reduction;

    protected bool $freeDelivery;

    protected float $amount = 0;

    protected bool $isActive = false;

    public function __construct(int $minAmount, int $reduction, bool $freeDelivery)
    {
        $this->minAmount = $minAmount;
        $this->reduction = $reduction;
        $this->freeDelivery = $freeDelivery;
    }

    public function getMinAmount(): int
    {
        return $this->minAmount;
    }

    public function isFreeDelivery(): bool
    {
        return $this->freeDelivery;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function setAmount(float $amount) {
        $this->amount = $amount;
    }

    public function getReduction(): int
    {
        return $this->reduction;
    }

    public function setReduction(int $reduction): void
    {
        $this->reduction = $reduction;
    }

    public function isActive(): bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): void
    {
        $this->isActive = $isActive;
    }
}
