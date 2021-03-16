<?php

namespace Tests\Feature\Services\StoresManagement;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Services\StoresManagement\Features\ListStoresFeature;
use App\Data\Models\Store;
use Database\Factories\data\Models\ProductFactory;

class ListStoresFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_list_stores_feature()
    {
        $stores = Store::factory(15)->create();

        $response = $this->get('/api/stores');

        $response
            ->assertStatus(200)
            ->assertJson([
                'status' => 200,
                'data' => []
            ])
            ->assertJsonCount(15, 'data');
    }

    public function test_list_stores_best_sellers_feature()
    {
        $factory = new ProductFactory();
        $factory->testProductsStores();

        $response = $this->get('/api/stores/orders/top-sellers');

        $response
            ->assertStatus(200)
            ->assertJson([
                'status' => 200,
                'data' => []
            ])
            ->assertJsonCount(75, 'data');
    }

    public function test_list_stores_top_billing_feature()
    {
        $factory = new ProductFactory();
        $factory->testProductsStores();

        $response = $this->get('/api/stores/orders/top-billing');

        $response
            ->assertStatus(200)
            ->assertJson([
                'status' => 200,
                'data' => []
            ])
            ->assertJsonCount(75, 'data');
    }
}
