<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class Utils extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('price', [$this, 'formatPrice']),
            new TwigFilter('img', [$this, 'imagePath']),
        ];
    }

    public function formatPrice($number, $decimals = 0, $decPoint = '.', $thousandsSep = ',')
    {
        if (floor($number) - $number < 0) {
            $price = number_format($number, $decimals, $decPoint, $thousandsSep);
        } else {
            $price = number_format($number, 0, $decPoint, $thousandsSep);
        }
        $price = $price.' €';

        return $price;
    }

    public function imagePath(string $file): string
    {
        return '/build/images/'.$file;
    }
}