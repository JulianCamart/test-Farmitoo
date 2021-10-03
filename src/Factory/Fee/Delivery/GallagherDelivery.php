<?php

namespace App\Factory\Fee\Delivery;

class GallagherDelivery extends Delivery  {

    protected const SUPPORTED_BRANDS = [
        2
    ];

    public function getSupportedBrand(): array
    {
        return $this::SUPPORTED_BRANDS;
    }

    public function setCost(array $items): void
    {
        $this->cost = 15;
    }
}
