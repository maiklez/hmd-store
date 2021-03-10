<?php

namespace Tests\Feature\Services\OrdersManagement;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Services\OrdersManagement\Features\CreateOrderFeature;
use App\Data\Models\Product;
use App\Data\Models\Store;
use App\Data\Models\Client;

class CreateOrderFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_order_feature()
    {
        $product = Product::factory(1)->create();
        $store = Store::factory(1)->create();
        $client = Client::factory(1)->create();

        $data = [
            'client_id' => $client[0]->id,
            'store_id' => $store[0]->id,
            'prod_id' => $product[0]->id,
            'quantity' => 1,
        ];

        $response = $this->post('/api/orders', $data);
        $response->assertStatus(201);
        $this->assertDatabaseCount('orders', 1);
    }

    public function test_create_order_feature_fail()
    {
        $data = [
            'user_id' => 1,
            'store_id' => 1,
            'quantity' => 1,
        ];

        $response = $this->post('/api/orders', $data);

        $response->assertStatus(422);
        $this->assertDatabaseCount('orders', 0);
    }
}
