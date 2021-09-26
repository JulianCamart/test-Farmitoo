<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProductRepository;

/**
 * @ORM\Entity(repositoryClass=BrandRepository::class)
 */
class Product
{
    use ResourceId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected string $title;

    /**
     * @ORM\Column(type="float", scale=2)
     */
    protected float $price;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected string $image;

    /**
    * @ORM\ManyToOne(targetEntity=Brand::class)
    */
    protected Brand $brand;

    public function __construct(string $title, float $price, string $image, Brand $brand)
    {
        $this->title = $title;
        $this->price = $price;
        $this->image = $image;
        $this->brand = $brand;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function getBrand(): Brand
    {
        return $this->brand;
    }
}
