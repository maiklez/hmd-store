<?php

namespace Tests\Feature\Services\ClientsManagement;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Services\ClientsManagement\Features\ListClientsFeature;
use App\Data\Models\Client;
use Database\Factories\data\Models\ProductFactory;

class ListClientsFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_list_clients_feature()
    {
        $clients = Client::factory(15)->create();

        $response = $this->get('/api/clients');

        $response
            ->assertStatus(200)
            ->assertJson([
                'status' => 200,
                'data' => []
            ])
            ->assertJsonCount(15, 'data');
    }

    public function test_list_clients_top__billing_feature()
    {
        $factory = new ProductFactory();
        $factory->testProductsStores();

        $response = $this->get('/api/clients/orders/top-buyers');

        $response
            ->assertStatus(200)
            ->assertJson([
                'status' => 200,
                'data' => []
            ])
            ->assertJsonCount(75, 'data');
    }
}
