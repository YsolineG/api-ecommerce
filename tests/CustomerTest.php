<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class CustomerTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed');
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreateCustomer()
    {
        $customer = [
            'name' => 'Ganster',
            'firstname' => 'Ysoline',
            'email' => 'ysoline.ganster@gmail.com',
            'adress' => 'Reims'
        ];

       $this->json('POST', '/api/v1/customers', $customer)
            ->seeJson($customer);
    }

    public function testShowAllCustomers()
    {
        $customer = [
            'name' => 'Ganster',
            'firstname' => 'Ysoline',
            'email' => 'ysoline.ganster@gmail.com',
            'adress' => 'Reims'
        ];

        $this->json('GET', '/api/v1/customers', $customer)
            ->seeJson($customer);
    }

    public function testUpdateCustomer()
    {
        $updateCustomer = [
            'name' => 'Halin',
            'firstname' => 'Jérémy',
            'email' => 'jeremy.halin@gmail.com',
            'adress' => 'Reims'
        ];

        $this->json('PUT', '/api/v1/customers/1', $updateCustomer)  
            ->seeJson($updateCustomer);
    }

    public function testShowCustomer()
    {
        $updateCustomer = [
            'name' => 'Halin',
            'firstname' => 'Jérémy',
            'email' => 'jeremy.halin@gmail.com',
            'adress' => 'Reims'
        ];

        $this->json('GET', '/api/v1/customers/1', $updateCustomer)  
            ->seeJson($updateCustomer);
    }

    public function testDeleteCustomer()
    {
        $this->json('DELETE', '/api/v1/customers/1')
            ->seeJson(['customer removed successfully']);
    }
}