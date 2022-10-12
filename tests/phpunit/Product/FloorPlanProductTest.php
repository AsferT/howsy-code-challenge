<?php

namespace App\Tests\Product;

use App\Product\FloorPlanProduct;
use PHPUnit\Framework\TestCase;

class FloorPlanProductTest extends TestCase
{
    private const PRODUCT_CODE = 'P002';
    private const NAME = 'Floorplan';
    private const PRICE = 100.0;

    private FloorPlanProduct $product;

    protected function setUp(): void
    {
        $this->product = new FloorPlanProduct(self::PRODUCT_CODE, self::NAME, self::PRICE);
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
