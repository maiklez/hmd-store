<?php

namespace Tests\Feature\Services\CategoriesManagement;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Services\CategoriesManagement\Features\CreateCategoryFeature;

class CreateCategoryFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_category_feature()
    {
        $data = [
            'name' => str_repeat('a', 100),
            'slug' => str_repeat('a', 50),
            'description' => str_repeat('a', 255),
        ];

        $response = $this->post('/api/categories', $data);

        $response->assertStatus(201);
        $this->assertDatabaseCount('categories', 1);
    }

    public function test_create_category_feature_fail()
    {
        $data = [
            'name' => str_repeat('a', 101),
            'slug' => str_repeat('a', 51),
            'description' => str_repeat('a', 256),
        ];

        $response = $this->post('/api/categories', $data);

        $response->assertStatus(422);
        $this->assertDatabaseCount('categories', 0);
    }
}
