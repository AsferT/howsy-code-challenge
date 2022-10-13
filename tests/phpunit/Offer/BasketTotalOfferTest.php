<?php

namespace App\Tests\Offer;

use App\Basket\Basket;
use App\Offer\BasketTotalOffer;
use App\User\User;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;

class BasketTotalOfferTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    private const DISCOUNT = 0.05;

    private Basket|MockInterface $basket;
    private User $user;
    private BasketTotalOffer $basketTotalOffer;

    /** @SuppressWarnings(PHPMD.StaticAccess) */
    protected function setUp(): void
    {
        $this->basket = Mockery::mock(Basket::class);
        $this->user = new User('phpunit');
        $this->basketTotalOffer = new BasketTotalOffer();
    }

    public function testGetDiscount(): void
    {
        $this->assertSame(self::DISCOUNT, $this->basketTotalOffer->getDiscount());
    }

    public function testSupportsWithBasketTotalHigh(): void
    {
        $this->basket->expects('getTotal')->andReturn(200.00);

        $this->assertTrue($this->basketTotalOffer->supports($this->user, $this->basket));
    }

    public function testSupportsWithBasketTotalLow(): void
    {
        $this->basket->expects('getTotal')->andReturn(100.00);

        $this->assertFalse($this->basketTotalOffer->supports($this->user, $this->basket));
    }
}
