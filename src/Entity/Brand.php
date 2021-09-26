<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\BrandRepository;

/**
 * @ORM\Entity(repositoryClass=BrandRepository::class)
 */
class Brand
{
    use ResourceId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected string $title;

    public function __construct(string $title)
    {
        $this->title = $title;
    }

    public function getTitle(): string
    {
        return $this->title;
    }
}