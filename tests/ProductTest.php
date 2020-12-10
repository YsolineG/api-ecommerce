<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use App\Models\Product;

class ProductTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        // $this->artisan('db:seed');
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testPostProduct()
    {
        $product = [
            'name' =>'Amoung Us', 
        'description' => 'jeu multijoueur', 
        'price' => 4, 
        'stock' => 2
        ];

        $this->json('POST', '/api/v1/products', $product)
            ->seeJson($product);
    }

    public function testGetProducts()
    {
        $products = Product::factory()->count(10)->create()->all();

        $this->json('GET', '/api/v1/products')
            ->seeJson($products);
    }

    public function testPutProduct()
    {
        $updateProduct = [
            'name' => 'Animal Crossing',
            'description' => 'jeu de simulation de vie', 
            'price' => 60, 
            'stock' => 2
        ];

        $this->json('PUT', '/api/v1/products/1', $updateProduct)  
            ->seeJson($updateProduct);
    }

    public function testGetProduct()
    {
        $updateProduct = [
            'name' => 'Animal Crossing',
            'description' => 'jeu de simulation de vie', 
            'price' => 60, 
            'stock' => 2
        ];

        $this->json('GET', '/api/v1/products/1', $updateProduct)  
            ->seeJson($updateProduct);
    }

    public function testDeleteProduct()
    {
        $this->json('DELETE', '/api/v1/products/1')
            ->seeJson(['product removed successfully']);
    }
}