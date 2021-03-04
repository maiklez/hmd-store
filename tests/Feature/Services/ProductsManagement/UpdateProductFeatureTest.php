<?php

namespace Tests\Feature\Services\ProductsManagement;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Services\ProductsManagement\Features\UpdateProductFeature;
use App\Data\Models\Product;

class UpdateProductFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_update_product_feature()
    {
        $products = Product::factory(1)->create();

        $data = [
            'name' => str_repeat('a', 100),
            'slug' => str_repeat('a', 50),
            'description' => str_repeat('a', 255),
            'price' => 4.55,
        ];

        $response = $this->put('/api/products/1', $data);

        $response->assertStatus(200);
        $this->assertDatabaseCount('products', 1);
    }

    public function test_update_product_feature_fail_422()
    {
        $products = Product::factory(2)->create();

        $data = [
            'name' => str_repeat('a', 100),
            'slug' => $products[0]->slug,
            'description' => str_repeat('a', 255),
            'price' => 4.55,
        ];

        $response = $this->put('/api/products/2', $data);

        $response->assertStatus(422);
    }

    public function test_update_product_feature_fail_404()
    {
        $data = [
            'name' => str_repeat('a', 100),
            'slug' => str_repeat('a', 50),
            'description' => str_repeat('a', 255),
            'price' => 4.55,
        ];

        $response = $this->put('/api/products/1', $data);

        $response->assertStatus(404);
        $this->assertDatabaseCount('products', 0);
    }
}
