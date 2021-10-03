<?php

namespace App\Factory\Promotion;

use App\Entity\Promotion;

class PromotionFactory
{
    protected array $promotions = [];

    public function __construct()
    {
        $this->promotions = [
            new Promotion(3500, 8, false),
            new Promotion(500, 4, true)
        ];
    }

    public function getPromotions(): array
    {
        return $this->promotions;
    }
}