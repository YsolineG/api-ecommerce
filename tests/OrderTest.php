<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class OrderTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testOrder()
    {
        $order = ['customer_id' => 1];

        $updateOrder = ['customer_id' => 2];

        $this->json('POST', '/api/v1/orders', $order)
            ->seeJson($order);

        $this->json('GET', '/api/v1/orders', $order)
            ->seeJson($order);

        $this->json('PUT', '/api/v1/orders/1', $updateOrder)  
            ->seeJson($updateOrder);

        $this->json('GET', '/api/v1/orders/1', $updateOrder)  
            ->seeJson($updateOrder);

        $this->json('DELETE', '/api/v1/orders/1')
            ->seeJson(['order removed successfully']); 
    }
}