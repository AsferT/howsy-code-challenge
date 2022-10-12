<?php

declare(strict_types=1);

namespace App\Offer;

use App\Basket\Basket;
use App\User\User;

interface OfferInterface
{
    public function getDiscount(): float;
    public function supports(User $user, Basket $basket): bool;
}
