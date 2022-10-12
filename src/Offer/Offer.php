<?php

declare(strict_types=1);

namespace App\Offer;

abstract class Offer implements OfferInterface
{
    protected float $discount = 0;

    public function getDiscount(): float
    {
        return $this->discount;
    }
}
