<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class CustomerTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCustomer()
    {
        $customer = [
            'name' => 'Ganster',
            'firstname' => 'Ysoline',
            'email' => 'ysoline.ganster@gmail.com',
            'adress' => 'Reims'
        ];

        $updateCustomer = [
            'name' => 'Halin',
            'firstname' => 'Jérémy',
            'email' => 'jeremy.halin@gmail.com',
            'adress' => 'Reims'
        ];

       $this->json('POST', '/api/v1/customers', $customer)
            ->seeJson($customer);

        $this->json('GET', '/api/v1/customers', $customer)
            ->seeJson($customer);

        $this->json('PUT', '/api/v1/customers/1', $updateCustomer)  
            ->seeJson($updateCustomer);

        $this->json('GET', '/api/v1/customers/1', $updateCustomer)  
            ->seeJson($updateCustomer);

        $this->json('DELETE', '/api/v1/customers/1')
            ->seeJson(['customer removed successfully']); 
    }
}