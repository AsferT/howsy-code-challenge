<?php

declare(strict_types=1);

namespace App\Basket;

use App\Product\Product;

interface BasketInterface
{
    public function add(Product $product): void;
    public function total(): void;
}
