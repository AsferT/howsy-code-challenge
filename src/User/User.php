<?php

declare(strict_types=1);

namespace App\User;

use App\Offer\Offer;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class User
{
    private Collection $offers;

    public function __construct(private readonly string $name)
    {
        $this->offers = new ArrayCollection();
    }

    public function addOffer(Offer $offer): void
    {
        $this->offers->add($offer);
    }

    /** @SuppressWarnings(PHPMD.UnusedFormalParameter) */
    public function hasOffer(string $offerClass): bool
    {
        return $this->offers->exists(
            function ($key, Offer $offer) use ($offerClass) {
                return $offer::class === $offerClass;
            }
        );
    }

    public function getOffers(): Collection
    {
        return $this->offers;
    }
}
