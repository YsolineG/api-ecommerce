<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use App\Models\Product;
use App\Models\Category;

class ProductTest extends TestCase
{
    use DatabaseMigrations;

    // public function setUp(): void
    // {
    //     parent::setUp();
    //     // $this->artisan('db:seed');
    // }

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
            'stock' => 2,
            'image' => 'C:\Users\Ysoline\Documents\Dev\site e-commerce\images\amoungus.jpg'

        ];

        $this->json('POST', '/api/v1/products', $product)
            ->seeJson($product);
    }

    public function testGetProducts()
    {
        $products = Product::factory()->count(10)->create();

        $response = $this->json('GET', '/api/v1/products');

        foreach($products as $product) {
            $response->seeJson($product->toArray());
        }
    }

    public function testPutProduct()
    {
        $existingProduct = Product::factory()->create();

        $dataToUpdate = [
            'name' => 'new product name',
            'description' => 'new product description',
            'price' => 20,
            'stock' => 40,
            'image' => 'C:\Users\Ysoline\Documents\Dev\site e-commerce\images\justdance.jpg'
        ];
        
        $this->json('PUT', '/api/v1/products/'. $existingProduct->id, $dataToUpdate)  
            ->seeJson($dataToUpdate);
    }

    public function testGetProduct()
    {
        $product = Product::factory()->create();

        $this->json('GET', '/api/v1/products/'. $product->id)  
            ->seeJson($product->toArray());
    }

    public function testDeleteProduct()
    {
        $product = Product::factory()->create();

        $this->json('DELETE', '/api/v1/products/'. $product->id)
            ->seeJson(['product removed successfully']);

        $this->missingFromDatabase('products', [
            'id' => $product->id
        ]);
    }

    public function testPostProductCategory()
    {
        $category = Category::factory()->create();

        $product = Product::factory()->create(); 

        $this->json('POST', '/api/v1/products/'.$product->id.'/categories', ['category_id' => $category->id])
            ->seeJson(['category_id' => $category->id]);
    }
}