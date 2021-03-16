<?php

namespace Tests\Feature\Services\OrdersManagement;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Services\OrdersManagement\Features\UpdateOrderFeature;
use App\Data\Models\Order;
use App\Data\Models\Product;
use App\Data\Models\Client;
use App\Data\Models\Store;

class UpdateOrderFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_update_order_feature()
    {
        $orders = Order::factory(1)->create();

        $product = Product::factory(1)->create();
        $store = Store::factory(1)->hasAttached($product)->create();
        $client = Client::factory(1)->create();

        $data = [
            'client_id' => 1,
            'store_id' => $store[0]->id,
            'id' => $orders[0]->id,
        ];

        $response = $this->put('/api/orders/1', $data);

        $response->assertStatus(200);
        $this->assertDatabaseCount('orders', 1);
    }

    public function test_add_product_order_feature()
    {
        $orders = Order::factory(1)->create();
        $product = Product::factory(1)->create();

        $data = [
            'quantity' => 1,
            'prod_id' => $product[0]->id,
            'id' => $orders[0]->id,
        ];

        $response = $this->post('/api/orders/1/products', $data);
        $response->assertStatus(200);
        $this->assertDatabaseCount('orders', 1);
    }

    public function test_add_product_order_feature_fail()
    {
        $product = Product::factory(1)->create();
        $orders = Order::factory(1)->hasAttached($product, ['quantity' => 1 ])->create();

        $data = [
            'quantity' => 1,
            'prod_id' => $product[0]->id,
            'id' => $orders[0]->id,
        ];

        $response = $this->post('/api/orders/1/products', $data);
        $response->assertStatus(422);
        $this->assertDatabaseCount('orders', 1);
    }

    public function test_update_order_feature_fail_422()
    {
        $orders = Order::factory(2)->create();

        $data = [
            'id' => 1,
            'prod_id' => 1,
            'client_id' => 1,
        ];

        $response = $this->put('/api/orders/2', $data);

        $response->assertStatus(422);
    }

    public function test_update_order_feature_fail_404()
    {
        $data = [
            'id' => 1,
            'store_id' => 1,
            'client_id' => 1,
        ];

        $response = $this->put('/api/orders/1', $data);

        $response->assertStatus(404);
        $this->assertDatabaseCount('orders', 0);
    }
}
