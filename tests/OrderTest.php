<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use App\Models\Order;
use App\Models\Customer;


class OrderTest extends TestCase
{
    use DatabaseMigrations;
    
    // public function setUp(): void
    // {
    //     parent::setUp();
    //     $this->artisan('db:seed');
    // }
    
    /**
     * A basic test example.
     *
     * @return void
     */

    public function testPostOrder()
    {
        $customer = Customer::factory()->create();

        $this->json('POST', '/api/v1/orders/', ['customer_id' => $customer->id])
            ->seeJson(['customer_id' => $customer->id]);
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

    // public function testDeleteOrder()
    // {
    //     $updateOrder = [
    //         'customer_id' => 1,
    //         'product_id' => 1,
    //         'quantity' => 1
    //     ];

    //     $this->json('DELETE', '/api/v1/orders/1', $updateOrder)
    //         ->seeJson($updateOrder);
    // }

    public function testDeleteOrder()
    {
        $customer = Customer::factory()->create();

        $this->json('DELETE', '/api/v1/orders/1')
            ->seeJson(['order removed successfully']);
            
            $this->missingFromDatabase('customers', [
            'id' => $customer->id
        ]);
    }
}