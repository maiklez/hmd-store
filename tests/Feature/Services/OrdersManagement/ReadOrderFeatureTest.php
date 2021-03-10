<?php

namespace Tests\Feature\Services\OrdersManagement;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Services\OrdersManagement\Features\ReadOrderFeature;
use App\Data\Models\Order;

class ReadOrderFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_read_order_feature()
    {

        $orders = Order::factory(1)->create();

        $response = $this->get('/api/orders/1');

        $response
            ->assertStatus(200)
            ->assertJson([
                'status' => 200,
                'data' => []
            ]);

        $this->assertDatabaseCount('orders', 1);
    }

    public function test_read_order_feature_fail()
    {
        $response = $this->get('/api/orders/1');

        $response->assertStatus(404);
        $this->assertDatabaseCount('orders', 0);
    }
}
