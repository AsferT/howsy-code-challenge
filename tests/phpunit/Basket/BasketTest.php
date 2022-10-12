<?php

namespace App\Tests\Basket;

use App\Basket\Basket;
use App\Exception\ProductMoreThanOneException;
use App\Offer\BasketTotalOffer;
use App\Offer\OneYearContractOffer;
use App\Product\EICRCertificateProduct;
use App\Product\FloorPlanProduct;
use App\Product\PhotographyProduct;
use App\User\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;

class BasketTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    private User|MockInterface $mockedUser;
    private Basket $basket;
    private Collection $products;

    protected function setUp(): void
    {
        $this->mockedUser = Mockery::mock(User::class);
        $this->products = new ArrayCollection();
    }

    public function testNoProducts(): void
    {
        $this->basket = new Basket($this->mockedUser);
        $this->assertEquals($this->products, $this->basket->getProducts());
    }

    public function testAddNewProduct(): void
    {
        $this->basket = new Basket($this->mockedUser);
        $product1 = new EICRCertificateProduct('P004', 'EICR Certificate', 51.00);
        $this->products->add($product1);

        $this->basket->add($product1);
        $this->assertEquals($this->products, $this->basket->getProducts());
    }

    /**
     * @throws ProductMoreThanOneException
     */
    public function testThrowMoreThanOneProductException(): void
    {
        $expectedExceptionErrorMessage = 'Product already exists in the basket. Only one of this product is allowed';
        $this->expectExceptionObject(new ProductMoreThanOneException($expectedExceptionErrorMessage));

        $this->basket = new Basket($this->mockedUser);
        $product1 = new EICRCertificateProduct('P004', 'EICR Certificate', 51.00);
        $this->products->add($product1);
        $this->products->add($product1);

        $this->basket->add($product1);
        $this->basket->add($product1);
    }

    public function testTotal(): void
    {
        $this->basket = new Basket($this->createUser());
        $photographyProduct = new PhotographyProduct('P001', 'Photography', 200);
        $floorPlanProduct = new FloorPlanProduct('P002', 'Floorplan', 100);
        $this->products->add($photographyProduct);
        $this->products->add($floorPlanProduct);

        $this->basket->add($photographyProduct);
        $this->basket->add($floorPlanProduct);
        $this->basket->total();

        // (100+200) * (1 - (0.10 + 0.05))
        // 300 * (1 - 0.15)
        // 300 * 0.85
        // 255
        $this->assertSame(255.00, $this->basket->getTotal());
    }

    private function createUser(): User
    {
        $user = new User('user4');
        $user->addOffer(new BasketTotalOffer());
        $user->addOffer(new OneYearContractOffer());

        return $user;
    }
}
