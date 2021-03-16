<?php

namespace Tests\Feature\Services\ProvidersManagement;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Services\ProvidersManagement\Features\ListProvidersFeature;
use App\Data\Models\Provider;
use App\Data\Models\Product;
use Database\Factories\data\Models\ProductFactory;

class ListProvidersFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_list_providers_feature()
    {
        $providers = Provider::factory(15)->create();

        $response = $this->get('/api/providers');

        $response
            ->assertStatus(200)
            ->assertJson([
                'status' => 200,
                'data' => []
            ])
            ->assertJsonCount(15, 'data');
    }

    public function test_list_providers_top__billing_feature()
    {
        Product::factory()->testProductsStores();

        $response = $this->get('/api/providers/orders/top-billing');

        $response
            ->assertStatus(200)
            ->assertJson([
                'status' => 200,
                'data' => []
            ])
            ->assertJsonCount(1, 'data');
    }
}
