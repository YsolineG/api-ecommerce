<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class ProductTest extends TestCase
{
    // use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreateProduct()
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

    public function testShowAllProducts()
    {
        $product = [
            'name' =>'Amoung Us', 
            'description' => 'jeu multijoueur', 
            'price' => 4, 
            'stock' => 2
        ];

        $this->json('GET', '/api/v1/products', $product)
            ->seeJson($product);
    }

    public function testUpdatePorduct()
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

    public function testShowProduct()
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