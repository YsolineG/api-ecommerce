<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use App\Models\Customer;

class CustomerTest extends TestCase
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
    public function testPostCustomer()
    {
        $customer = [
            'name' => 'Ganster',
            'firstname' => 'Ysoline',
            'email' => 'ysoline.ganster@gmail.com',
            'address' => 'Reims'
        ];

       $this->json('POST', '/api/v1/customers', $customer)
            ->seeJson($customer);
    }

    public function testGetCustomers()
    {
        $customers = Customer::factory()->count(10)->create();

        $response = $this->json('GET', '/api/v1/customers');

        foreach($customers as $customer) {
            $response->seeJson($customer->toArray());
        }
    }

    public function testPutCustomer()
    {
        $existingCustomer = Customer::factory()->create();

        $dataToUpdate = [
            'name'=>'New customer name',
            'firstname'=>'New customer firstname',
            'email'=>'newcustomeremail@gmail.com',
            'address'=>'New customer address'
        ];

        $this->json('PUT', '/api/v1/customers/'. $existingCustomer->id, $dataToUpdate)  
            ->seeJson($dataToUpdate);
    }

    public function testGetCustomer()
    {
        $customer = Customer::factory()->create();

        $this->json('GET', '/api/v1/customers/'. $customer->id)  
            ->seeJson($customer->toArray());
    }

    public function testDeleteCustomer()
    {
        $customer = Customer::factory()->create();

        $this->json('DELETE', '/api/v1/customers/'. $customer->id)
            ->seeJson(['customer removed successfully']);

        $this->missingFromDatabase('customers', [
            'id' => $customer->id
        ]);
    }
}