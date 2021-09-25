<?php


namespace App\Entity;


class Brand
{
    /**
     * @var string
     */
    protected $title;

    /**
     * @param string $title
     */
    public function __construct(string $title)
    {
        $this->title = $title;
    }
}