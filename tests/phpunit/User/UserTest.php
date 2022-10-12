<?php

namespace App\Tests\User;

use App\Offer\BasketTotalOffer;
use App\Offer\OneYearContractOffer;
use App\User\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    private User $user;
    private Collection $offers;

    protected function setUp(): void
    {
        $this->user = new User('phpunit');
        $this->offers = new ArrayCollection();
    }

    public function testAddOffersNone(): void
    {
        // No offers added
        $this->assertOfferWithUserOffers();
    }

    public function testAddOffersSingle(): void
    {
        $this->setupSingleOffer();
        $this->assertOfferWithUserOffers();
    }

    public function testAddOffersMultiple(): void
    {
        $basketTotalOffer = new BasketTotalOffer();
        $oneYearContractOffer = new OneYearContractOffer();
        $this->offers->add($basketTotalOffer);
        $this->offers->add($oneYearContractOffer);

        $this->user->addOffer($basketTotalOffer);
        $this->user->addOffer($oneYearContractOffer);
        $this->assertOfferWithUserOffers();
    }

    public function testHasOffer(): void
    {
        $this->setupSingleOffer();
        $this->assertTrue($this->user->hasOffer(BasketTotalOffer::class));
    }

    public function testHasNotOffer(): void
    {
        $this->setupSingleOffer();
        $this->assertFalse($this->user->hasOffer(OneYearContractOffer::class));
    }

    private function assertOfferWithUserOffers(): void
    {
        $this->assertEquals($this->offers, $this->user->getOffers());
    }

    private function setupSingleOffer(): void
    {
        $basketTotalOffer = new BasketTotalOffer();
        $this->offers->add($basketTotalOffer);

        $this->user->addOffer($basketTotalOffer);
    }
}
