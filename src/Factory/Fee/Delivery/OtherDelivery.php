<?php

namespace App\Factory\Fee\Delivery;

use App\Entity\Item;

class OtherDelivery extends Delivery
{
    protected const SUPPORTED_BRANDS = [
        3, 4 , 5, 6, 7, 8, 9, 10, 11, 12, 13
    ];

    public function getSupportedBrand(): array
    {
        return $this::SUPPORTED_BRANDS;
    }

    public function setCost(array $items): void
    {
        $this->cost = ceil(array_sum(array_map(fn(Item $item) => $item->getQuantity(), $items)) / 2) * 5;
    }
}
