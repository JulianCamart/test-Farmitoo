<?php

namespace App\Factory\Fee\Vat;

use App\Entity\Item;
use App\Factory\Fee\Fee;

abstract class Vat extends Fee
{
    abstract public function getPercent(): int;

    protected int $percent;

    public function setCost(array $items): void
    {
        $this->cost = array_sum(array_map(fn(Item $item) => $item->getTotalPriceAfterPromotion() ?? $item->getTotalPrice(), $items)) * ($this->getPercent() / 100);
    }
}