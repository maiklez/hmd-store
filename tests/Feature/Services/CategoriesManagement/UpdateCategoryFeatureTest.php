<?php

namespace Tests\Feature\Services\CategoriesManagement;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Services\CategoriesManagement\Features\UpdateCategoryFeature;
use App\Data\Models\Category;

class UpdateCategoryFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_update_category_feature()
    {
        $categories = Category::factory(1)->create();

        $data = [
            'name' => str_repeat('a', 100),
            'slug' => str_repeat('a', 50),
            'description' => str_repeat('a', 255),
        ];

        $response = $this->put('/api/categories/1', $data);

        $response->assertStatus(200);
        $this->assertDatabaseCount('categories', 1);
    }

    public function test_update_category_feature_fail_422()
    {
        $categories = Category::factory(2)->create();

        $data = [
            'name' => str_repeat('a', 100),
            'slug' => $categories[0]->slug,
            'description' => str_repeat('a', 255),
        ];

        $response = $this->put('/api/categories/2', $data);

        $response->assertStatus(422);
    }

    public function test_update_category_feature_fail_404()
    {
        $data = [
            'name' => str_repeat('a', 100),
            'slug' => str_repeat('a', 50),
            'description' => str_repeat('a', 255),
        ];

        $response = $this->put('/api/categories/1', $data);

        $response->assertStatus(404);
        $this->assertDatabaseCount('categories', 0);
    }
}
