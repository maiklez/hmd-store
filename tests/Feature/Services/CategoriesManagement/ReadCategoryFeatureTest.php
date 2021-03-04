<?php

namespace Tests\Feature\Services\CategoriesManagement;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Services\CategoriesManagement\Features\ReadCategoryFeature;
use App\Data\Models\Category;

class ReadCategoryFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_read_category_feature()
    {

        $categories = Category::factory(1)->create();

        $response = $this->get('/api/categories/1');

        $response
            ->assertStatus(200)
            ->assertJson([
                'status' => 200,
                'data' => []
            ]);

        $this->assertDatabaseCount('categories', 1);
    }

    public function test_read_category_feature_fail()
    {
        $response = $this->get('/api/categories/1');

        $response->assertStatus(404);
        $this->assertDatabaseCount('categories', 0);
    }
}
