<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class ProductTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testProduct()
    {
        $product = [
            'name' =>'Amoung Us', 
            'description' => 'jeu d\'ambiance multijoueur', 
            'price' => 4, 
            'stock' => 2
        ];

        $updateProduct = [
            'name' => 'Animal Crossing',
            'description' => 'jeu de simulation de vie', 
            'price' => 60, 
            'stock' => 2
        ];

        $this->json('POST', '/api/v1/products', $product)
            ->seeJson($product);

        $this->json('GET', '/api/v1/products', $product)
            ->seeJson($product);

        $this->json('PUT', '/api/v1/products/1', $updateProduct)  
            ->seeJson($updateProduct);

        $this->json('GET', '/api/v1/products/1', $updateProduct)  
            ->seeJson($updateProduct);

        $this->json('DELETE', '/api/v1/products/1')
            ->seeJson(['product removed successfully']);

        // $this->json('GET', '/api/v1/products/1/categories', $product)
        //     ->seeJson($product);
    }
}