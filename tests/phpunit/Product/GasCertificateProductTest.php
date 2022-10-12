<?php

namespace App\Tests\Product;

use App\Product\GasCertificateProduct;
use PHPUnit\Framework\TestCase;

class GasCertificateProductTest extends TestCase
{
    private const PRODUCT_CODE = 'P003';
    private const NAME = 'Gas Certificate';
    private const PRICE = 83.50;

    private GasCertificateProduct $product;

    protected function setUp(): void
    {
        $this->product = new GasCertificateProduct(self::PRODUCT_CODE, self::NAME, self::PRICE);
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
