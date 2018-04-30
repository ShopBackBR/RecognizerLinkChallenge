<?php
declare(strict_types=1);

namespace LinkRecognizer;

class Product
{
    private $id;
    private $title;
    private $price;
    private $link;

    public function __construct(string $id, string $title, float $price, string $link)
    {
        $this->id = $id;
        $this->title = $title;
        $this->price = $price;
        $this->link = $link;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getLink(): string
    {
        return $this->link;
    }
}
