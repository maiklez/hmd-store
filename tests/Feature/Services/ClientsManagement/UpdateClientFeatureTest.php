<?php

namespace Tests\Feature\Services\ClientsManagement;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Services\ClientsManagement\Features\UpdateClientFeature;
use App\Data\Models\Client;

class UpdateClientFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_update_client_feature()
    {
        $clients = Client::factory(1)->create();

        $data = [
            'name' => str_repeat('a', 100),
            'email' => 'test@test.es',
        ];

        $response = $this->put('/api/clients/1', $data);

        $response->assertStatus(200);
        $this->assertDatabaseCount('clients', 1);
    }

    public function test_update_client_feature_fail_422()
    {
        $clients = Client::factory(2)->create();

        $data = [
            'name' => str_repeat('a', 100),
            'email' => $clients[0]->slug,
        ];

        $response = $this->put('/api/clients/2', $data);

        $response->assertStatus(422);
    }

    public function test_update_client_feature_fail_404()
    {
        $data = [
            'name' => str_repeat('a', 100),
            'email' => 'test@test.es',
        ];

        $response = $this->put('/api/clients/1', $data);

        $response->assertStatus(404);
        $this->assertDatabaseCount('clients', 0);
    }
}
