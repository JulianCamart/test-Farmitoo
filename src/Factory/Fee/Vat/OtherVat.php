<?php

namespace App\Factory\Fee\Vat;

class OtherVat extends Vat {

    protected const SUPPORTED_BRANDS = [
        3, 4 , 5, 6, 7, 8, 9, 10, 11, 12, 13
    ];

    protected int $percent = 12;

    public function getSupportedBrand(): array
    {
        return $this::SUPPORTED_BRANDS;
    }

    public function getPercent(): int
    {
        return $this->percent;
    }
}
