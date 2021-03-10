<?php

namespace Tests\Feature\Services\OrdersManagement;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Services\OrdersManagement\Features\ListOrdersFeature;
use App\Data\Models\Order;

class ListOrdersFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_list_orders_feature()
    {
        $orders = Order::factory(15)->create();

        $response = $this->get('/api/orders');

        $response
            ->assertStatus(200)
            ->assertJson([
                'status' => 200,
                'data' => []
            ])
            ->assertJsonCount(15, 'data');
    }
}
