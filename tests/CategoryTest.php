<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class CategoryTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCategory()
    {
        $category = ['name' => 'Switch'];

        $updateCategory = ['name' => 'Playstation'];

       $this->json('POST', '/api/v1/categories', $category)
            ->seeJson($category);

        $this->json('GET', '/api/v1/categories', $category)
            ->seeJson($category);

        $this->json('PUT', '/api/v1/categories/1', $updateCategory)  
            ->seeJson($updateCategory);

        $this->json('GET', '/api/v1/categories/1', $updateCategory)  
            ->seeJson($updateCategory);

        $this->json('DELETE', '/api/v1/categories/1')
            ->seeJson(['category removed successfully']); 
    }
}
