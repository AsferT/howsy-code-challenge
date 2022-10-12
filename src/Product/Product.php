<?php

declare(strict_types=1);

namespace App\Product;

abstract class Product implements ProductInterface
{
    public function __construct(
        protected readonly string $productCode,
        protected readonly string $name,
        protected readonly float $price
    ) {
    }

    public function getProductCode(): string
    {
        return $this->productCode;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }
}
