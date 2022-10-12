<?php

declare(strict_types=1);

namespace App\Basket;

use App\Exception\ProductMoreThanOneException;
use App\Offer\Offer;
use App\Product\Product;
use App\User\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Basket implements BasketInterface
{
    private Collection $products;
    private float $total;

    public function __construct(private readonly User $user)
    {
        $this->products = new ArrayCollection();
    }

    /**
     * @throws ProductMoreThanOneException
     */
    public function add(Product $product)
    {
        if ($this->products->contains($product)) {
            throw new ProductMoreThanOneException(
                'Product already exists in the basket. Only one of this product is allowed'
            );
        }
        $this->products->add($product);
    }

    public function total(): void
    {
        $this->total = $this->products->reduce(
            function ($total, Product $product): float {
                return $total + $product->getPrice();
            }
        );
        if ($this->user->getOffers()->count()) {
            $this->applyOffers();
        }
    }

    public function getTotal(): float
    {
        return $this->total;
    }

    public function getProducts(): Collection
    {
        return $this->products;
    }

    private function applyOffers(): void
    {
        $totalDiscounts = $this->user->getOffers()->reduce(
            function ($total, Offer $offer): float {
                return $total + ($offer->supports($this->user, $this) ? $offer->getDiscount() : 0);
            }
        );
        $this->total = $this->total * (1 - $totalDiscounts);
    }
}
