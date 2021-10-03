<?php

namespace App\Factory\Fee\Vat;

class FarmitooVat extends Vat {

    protected const SUPPORTED_BRANDS = [
        1
    ];

    protected int $percent = 20;

    public function getSupportedBrand(): array
    {
        return $this::SUPPORTED_BRANDS;
    }

    public function getPercent(): int
    {
        return $this->percent;
    }
}