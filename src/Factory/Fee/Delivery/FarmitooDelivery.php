<?php

namespace App\Factory\Fee\Delivery;

use App\Entity\Item;

class FarmitooDelivery extends Delivery {

    protected const SUPPORTED_BRANDS = [
        1
    ];

    public function getSupportedBrand(): array
    {
        return $this::SUPPORTED_BRANDS;
    }

    public function setCost(array $items): void
    {
        $this->cost = ceil(array_sum(array_map(fn(Item $item) => $item->getQuantity(), $items)) / 3) * 20;
    }
}