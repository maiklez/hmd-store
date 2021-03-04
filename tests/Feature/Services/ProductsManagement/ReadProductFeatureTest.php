<?php

namespace Tests\Feature\Services\ProductsManagement;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Services\ProductsManagement\Features\ReadProductFeature;
use App\Data\Models\Product;

class ReadProductFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_read_product_feature()
    {

        $products = Product::factory(1)->create();

        $response = $this->get('/api/products/1');

        $response
            ->assertStatus(200)
            ->assertJson([
                'status' => 200,
                'data' => []
            ]);

        $this->assertDatabaseCount('products', 1);
    }

    public function test_read_product_feature_fail()
    {
        $response = $this->get('/api/products/1');

        $response->assertStatus(404);
        $this->assertDatabaseCount('products', 0);
    }
}
