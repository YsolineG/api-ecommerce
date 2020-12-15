<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Product;


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

    public function testGetOrders()
    {
        $customers = Customer::factory()->count(10)->create();
        $this->json('GET','/api/v1/orders/')
            ->seeJson(['customer_id'=> $customers->id]);
    }

    public function testGetOrder()
    {
        $customers = Customer::factory()->create();

        $this->get('/api/v1/orders/1')
            ->seeJson();
    }

    public function testDeleteOrder()
    {
        $customer = Customer::factory()->create();
        $order = new Order;
        $order->customer_id = $customer->id;
        $order->save();

        $this->json('DELETE', '/api/v1/orders/'. $order->id)
            ->seeJson(['order removed successfully']);
            
            $this->missingFromDatabase('orders', [
            'id' => $order->id
        ]);
    }

    public function testPostOrderProduct()
    {
        $customer = Customer::factory()->create();

        $product = Product::factory()->create();

        $order = Order::factory()->create();

        $order = new Order;
        $order->customer_id = $customer->id;
        $order->save();

        $this->json(
                'POST', 
                '/api/v1/orders/'.$order->id.'/products', 
                // ['customer_id' => $customer->id], 
                ['product_id'=>$product->id], 
                ['order_id'=>$order->id])
            ->seeJson(
                // ['customer_id' => $customer->id], 
                ['product_id'=>$product->id], 
                ['order_id'=>$order->id]);
    }

    // public function testDeleteOrderProduct()
    // {

    // }
}