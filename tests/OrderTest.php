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

    public function testGetAllOrders()
    {
        $customer = Customer::factory()->create();
        
        $orders = Order::factory()->count(4)->create([
            'customer_id' => $customer->id
        ]);

        $response = $this->json('GET', '/api/v1/orders');
        foreach($orders as $order) {
            $response->seeJson($order->toArray());
        }
        
    }

    public function testGetOrder()
    {
        $customer = Customer::factory()->create();

        $order = Order::factory()->create([
            'customer_id' => $customer->id
        ]);

        $this->get('/api/v1/orders/'. $order->id)
            ->seeJson($order->toArray);
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
        // création d'un client
        $customer = Customer::factory()->create();

        // création d'une commande pour un client
        $order = Order::factory()->create([
            'customer_id' => $customer->id
        ]);

        // création du produit que l'on souhaite rattacher à la commande
        $product = Product::factory()->create();

        $this->json('POST', '/api/v1/orders/'.$order->id.'/products', ['product_id'=>$product->id, 'quantity'=>4])
            ->seeJson(['product_id'=>$product->id, 'quantity'=>4]);
    }

    public function testPutOrderProduct()
    {
        $existingCustomer = Customer::factory()->create();

        $existingOrder = Order::factory()->create([
            'customer_id' => $existingCustomer->id
        ]);

        $existingProduct = Product::factory()->create();

        $dataToUpdate = [
            'product_id' => $existingProduct->id,
            'quantity' => 6
        ];

        $this->json('PUT', '/api/v1/orders/'.$existingOrder->id.'/products', $dataToUpdate)
            ->seeJson($dataToUpdate);
    }

    public function testDeleteOrderProduct()
    {
        $customer = Customer::factory()->create();
        
        $order = Order::factory()->create([
            'customer_id' => $customer->id
        ]);

        $this->json('DELETE', '/api/v1/orders/'.$order->id.'/products')
            ->seeJson(['product removed successfully']);
        }
}
