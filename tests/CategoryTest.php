<?php

use App\Models\Product;
use App\Models\Category;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class CategoryTest extends TestCase
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
    public function testPostCategory()
    {
        $category = ['name' => 'Switch'];

        $this->json('POST', '/api/v1/categories', $category)
             ->seeJson($category);
    }

    public function testGetCategories()
    {
        // create multiple categories
        $categories = Category::factory()->count(4)->create();

        $response = $this->json('GET', '/api/v1/categories');

        foreach($categories as $category) {
            $response->seeJson($category->toArray());
        }
    }

    public function testPutCategory()
    {
        $existingCategory = Category::factory()->create();

        $dataToUpdate = [
            'name' => 'new category name'
        ];

        $this->json('PUT', '/api/v1/categories/'. $existingCategory->id, $dataToUpdate)
            ->seeJson($dataToUpdate);
    }

    public function testGetCategory()
    {
        $category = Category::factory()->create();

        $this->json('GET', '/api/v1/categories/'. $category->id)
            ->seeJson($category->toArray());
    }

    public function testDeleteCategory()
    {
        $category = Category::factory()->create();

        $this->json('DELETE', '/api/v1/categories/'. $category->id)
            ->seeJson(['category removed successfully']);

        $this->missingFromDatabase('categories', [
            'id' => $category->id
        ]);
    }

    public function testPostCategoryProduct()
    {
        $product = Product::factory()->create();

        $category = Category::factory()->create(); 

        $this->json('POST', '/api/v1/categories/'.$category->id.'/products', ['product_id' => $product->id])
            ->seeJson(['product_id' => $product->id]);
    }
}
