<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class OrderTest extends TestCase
{
    // use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */
    
    public function testCreateOrder()
    {
        $order = [
            'customer_id' => 1,
            'product_id'=> 1,
            'quantity' => 2
        ];

        $this->json('POST', '/api/v1/orders', $order)
            ->seeJson($order);
    
    }

    public function testShowAllOrder()
    {
        $order = [
            'customer_id' => 1,
            'product_id'=> 1,
            'quantity' => 2
        ];

        $this->get('/api/v1/orders/')
            ->seeJson($order);
    }

    public function testUpdateOrder()
    {
        $updateOrder = [
            'customer_id' => 1,
            'product_id' => 1,
            'quantity'=> 1,
        ];

        $this->json('PUT', '/api/v1/orders/1', $updateOrder)
            ->seeJson($updateOrder);
    }

    public function testShowOrder()
    {
        $updateOrder = [
            'customer_id' => 1,
            'product_id' => 1,
            'quantity' => 1,
        ];

        $this->get('/api/v1/orders/1')
            ->seeJson($updateOrder);
    }

    public function testDeleteOrder()
    {
        $updateOrder = [
            'customer_id' => 1,
            'product_id' => 1,
            'quantity' => 1
        ];

        $this->json('DELETE', '/api/v1/orders/1', $updateOrder)
            ->seeJson($updateOrder);
    }
}