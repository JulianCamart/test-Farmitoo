<?php

namespace App\Factory\Fee;

use App\Entity\Brand;

abstract class Fee
{

    abstract public function setCost(array $items): void;
    abstract public function getSupportedBrand(): array;

    protected float $cost;
    protected Brand $brand;

    public function getBrand(): Brand
    {
        return $this->brand;
    }

    public function setBrand(Brand $brand): void
    {
        $this->brand = $brand;
    }

    public function getCost(): float
    {
        return $this->cost;
    }
}