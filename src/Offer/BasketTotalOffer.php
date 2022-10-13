<?php

declare(strict_types=1);

namespace App\Offer;

use App\Basket\Basket;
use App\User\User;

class BasketTotalOffer extends Offer
{
    protected float $discount = 0.05;

    /** @SuppressWarnings(PHPMD.UnusedFormalParameter) */
    public function supports(User $user, Basket $basket): bool
    {
        return $basket->getTotal() >= 150.00;
    }
}
