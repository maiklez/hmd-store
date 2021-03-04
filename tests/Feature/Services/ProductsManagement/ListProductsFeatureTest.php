<?php

namespace Tests\Feature\Services\ProductsManagement;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Services\ProductsManagement\Features\ListProductsFeature;
use App\Data\Models\Product;

class ListProductsFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_list_products_feature()
    {
        $products = Product::factory(15)->create();

        $response = $this->get('/api/products');

        $response
            ->assertStatus(200)
            ->assertJson([
                'status' => 200,
                'data' => []
            ])
            ->assertJsonCount(15, 'data');
    }
}
