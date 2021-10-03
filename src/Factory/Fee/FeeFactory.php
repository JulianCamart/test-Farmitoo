<?php

namespace App\Factory\Fee;

use App\Factory\Fee\Delivery\Delivery;
use App\Factory\Fee\Vat\Vat;
use Exception;

class FeeFactory
{
    protected array $deliveryFeesInstances;
    protected array $vatFeesInstances;

    /**
     * @param array<Delivery> $deliveryFeesInstances
     * @param array<Vat> $vatFeesInstances
     */
    public function __construct(iterable $deliveryFeesInstances, iterable $vatFeesInstances)
    {
        $this->deliveryFeesInstances = [...$deliveryFeesInstances];
        $this->vatFeesInstances = [...$vatFeesInstances];
    }

    /**
     * @throws Exception
     */
    public function createDelivery(array $items): Delivery
    {
        $brand = $items[0]->getProduct()->getBrand();

        /** @var Delivery $deliveryFees */
        foreach ($this->deliveryFeesInstances as $deliveryFee) {
            if(in_array($brand->getId(), $deliveryFee->getSupportedBrand())) {
                $deliveryFee = clone $deliveryFee;
                $deliveryFee->setBrand($brand);
                $deliveryFee->setCost($items);
                return $deliveryFee;

            }
        }

        throw new Exception('Not supported delivering fees for brandId ' . $brand->getId());
    }

    /**
     * @throws Exception
     */
    public function createVat(array $items): Vat
    {
        $brand = $items[0]->getProduct()->getBrand();

        /** @var Vat $vatFeesInstance */
        foreach ($this->vatFeesInstances as $vatFee) {
            if(in_array($brand->getId(), $vatFee->getSupportedBrand())) {
                $vatFee = clone $vatFee;
                $vatFee->setBrand($brand);
                $vatFee->setCost($items);
                return $vatFee;
            }
        }

        throw new Exception('Not supported vat fees for brandId ' . $brand->getId());
    }
}