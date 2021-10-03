<?php

namespace App\Factory\Fee\Vat;

class GallagherVat extends Vat {

    protected const SUPPORTED_BRANDS = [
        2
    ];

    protected int $percent = 5;


    public function getSupportedBrand(): array
    {
        return $this::SUPPORTED_BRANDS;
    }

    public function getPercent(): int
    {
        return $this->percent;
    }
}
