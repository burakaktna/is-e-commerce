<?php

namespace Tests\Unit\Repository;

use App\Models\Product;
use App\Repository\ProductRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductRepositoryTest extends TestCase
{
    use RefreshDatabase;

    private ProductRepository $productRepository;

    public function setUp(): void
    {
        parent::setUp();
        $this->productRepository = new ProductRepository(new Product());
    }

    public function test_can_create_product()
    {
        $data = [
            'name' => 'Test Product',
            'category' => 1,
            'price' => 100,
            'stock' => 50,
        ];

        $product = $this->productRepository->create($data);

        $this->assertInstanceOf(Product::class, $product);
        $this->assertEquals($data['name'], $product->name);
        $this->assertEquals($data['category'], $product->category);
        $this->assertEquals($data['price'], $product->price);
        $this->assertEquals($data['stock'], $product->stock);
    }

    public function test_can_update_product()
    {
        $product = Product::factory()->create();

        $data = [
            'name' => 'Updated Product',
            'category' => 1,
            'price' => 200,
            'stock' => 100,
        ];

        $updatedProduct = (bool)$this->productRepository->update($product->id, $data);

        $this->assertTrue($updatedProduct);
        $this->assertEquals($data['name'], $product->fresh()->name);
        $this->assertEquals($data['category'], $product->fresh()->category);
        $this->assertEquals($data['price'], $product->fresh()->price);
        $this->assertEquals($data['stock'], $product->fresh()->stock);
    }

    public function test_can_delete_product()
    {
        $product = Product::factory()->create();

        $deletedProduct = $this->productRepository->delete($product->id);

        $this->assertTrue($deletedProduct);
        $this->assertNull(Product::find($product->id));
    }

    public function test_can_show_product()
    {
        $product = Product::factory()->create();

        $foundProduct = $this->productRepository->find($product->id);

        $this->assertInstanceOf(Product::class, $foundProduct);
        $this->assertEquals($foundProduct->name, $product->name);
        $this->assertEquals($foundProduct->category, $product->category);
        $this->assertEquals($foundProduct->price, $product->price);
        $this->assertEquals($foundProduct->stock, $product->stock);
    }

    public function test_can_get_all_products()
    {
        Product::factory()->count(5)->create();

        $allProducts = $this->productRepository->all();

        $this->assertCount(5, $allProducts);
    }
}
