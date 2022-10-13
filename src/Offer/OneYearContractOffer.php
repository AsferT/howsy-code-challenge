<?php

declare(strict_types=1);

namespace App\Offer;

use App\Basket\Basket;
use App\User\User;

class OneYearContractOffer extends Offer
{
    protected float $discount = 0.10;

    /** @SuppressWarnings(PHPMD.UnusedFormalParameter) */
    public function supports(User $user, Basket $basket): bool
    {
        return $user->hasOffer(self::class);
    }
}
