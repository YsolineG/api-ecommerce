<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class CategoryTest extends TestCase
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
    public function testCreateCategory()
    {
        $category = ['name' => 'Switch'];

       $this->json('POST', '/api/v1/categories', $category)
            ->seeJson($category); 
    }

    public function testShowAllCategories()
    {
        $category = ['name' => 'Switch'];

        $this->json('GET', '/api/v1/categories', $category)
            ->seeJson($category);
    }

    public function testUpdateCategory()
    {
        $updateCategory = ['name' => 'Playstation'];

        $this->json('PUT', '/api/v1/categories/1', $updateCategory)  
            ->seeJson($updateCategory);
    }

    public function testShowCategory()
    {
        $updateCategory = ['name' => 'Playstation'];

        $this->json('GET', '/api/v1/categories/1', $updateCategory)  
            ->seeJson($updateCategory);
    }

    public function testDeleteCategory()
    {
        $this->json('DELETE', '/api/v1/categories/1')
            ->seeJson(['category removed successfully']);
    }
}
