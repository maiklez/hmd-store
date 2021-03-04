<?php

namespace Tests\Feature\Services\ProductsManagement;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Services\ProductsManagement\Features\CreateProductFeature;

class CreateProductFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_product_feature()
    {
        $data = [
            'name' => str_repeat('a', 100),
            'slug' => str_repeat('a', 50),
            'description' => str_repeat('a', 255),
            'price' => 4.55,
        ];

        $response = $this->post('/api/products', $data);

        $response->assertStatus(201);
        $this->assertDatabaseCount('products', 1);
    }

    public function test_create_product_feature_fail()
    {
        $data = [
            'title' => str_repeat('a', 255),
            'ingredients' => str_repeat('a', 255),
            'instructions' => str_repeat('a', 255),
        ];

        $response = $this->post('/api/products', $data);

        $response->assertStatus(422);
        $this->assertDatabaseCount('products', 0);
    }
}
