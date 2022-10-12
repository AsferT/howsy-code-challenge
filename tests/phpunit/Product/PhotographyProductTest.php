<?php

namespace App\Tests\Product;

use App\Product\PhotographyProduct;
use PHPUnit\Framework\TestCase;

class PhotographyProductTest extends TestCase
{
    private const PRODUCT_CODE = 'P001';
    private const NAME = 'Photography';
    private const PRICE = 200.0;

    private PhotographyProduct $product;

    protected function setUp(): void
    {
        $this->product = new PhotographyProduct(self::PRODUCT_CODE, self::NAME, self::PRICE);
    }

    public function testProductCode(): void
    {
        $this->assertSame(self::PRODUCT_CODE, $this->product->getProductCode());
    }

    public function testName(): void
    {
        $this->assertSame(self::NAME, $this->product->getName());
    }

    public function testPrice(): void
    {
        $this->assertSame(self::PRICE, $this->product->getPrice());
    }
}
