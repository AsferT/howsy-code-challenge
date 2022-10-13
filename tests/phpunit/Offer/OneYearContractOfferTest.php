<?php

namespace App\Tests\Offer;

use App\Basket\Basket;
use App\Offer\OneYearContractOffer;
use App\User\User;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;

class OneYearContractOfferTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    private const DISCOUNT = 0.10;

    private Basket|MockInterface $basket;
    private User|MockInterface $user;
    private OneYearContractOffer $oneYearContractOffer;

    /** @SuppressWarnings(PHPMD.StaticAccess) */
    protected function setUp(): void
    {
        $this->basket = Mockery::mock(Basket::class);
        $this->user = Mockery::mock(User::class);
        $this->oneYearContractOffer = new OneYearContractOffer();
    }

    public function testGetDiscount(): void
    {
        $this->assertSame(self::DISCOUNT, $this->oneYearContractOffer->getDiscount());
    }

    public function testSupportsWithOffer(): void
    {
        $this->user->expects('hasOffer')->andReturnTrue();

        $this->assertTrue($this->oneYearContractOffer->supports($this->user, $this->basket));
    }

    public function testSupportsWithoutOffer(): void
    {
        $this->user->expects('hasOffer')->andReturnFalse();

        $this->assertFalse($this->oneYearContractOffer->supports($this->user, $this->basket));
    }
}
