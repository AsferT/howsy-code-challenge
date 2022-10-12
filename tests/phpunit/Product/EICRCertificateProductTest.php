<?php

namespace App\Tests\Product;

use App\Product\EICRCertificateProduct;
use PHPUnit\Framework\TestCase;

class EICRCertificateProductTest extends TestCase
{
    private const PRODUCT_CODE = 'P004';
    private const NAME = 'EICR Certificate';
    private const PRICE = 51.00;

    private EICRCertificateProduct $product;

    protected function setUp(): void
    {
        $this->product = new EICRCertificateProduct(self::PRODUCT_CODE, self::NAME, self::PRICE);
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
