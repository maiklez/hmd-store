<?php

namespace Tests\Feature\Services\ClientsManagement;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Services\ClientsManagement\Features\ReadClientFeature;
use App\Data\Models\Client;

class ReadClientFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_read_client_feature()
    {

        $clients = Client::factory(1)->create();

        $response = $this->get('/api/clients/1');

        $response
            ->assertStatus(200)
            ->assertJson([
                'status' => 200,
                'data' => []
            ]);

        $this->assertDatabaseCount('clients', 1);
    }

    public function test_read_client_feature_fail()
    {
        $response = $this->get('/api/clients/1');

        $response->assertStatus(404);
        $this->assertDatabaseCount('clients', 0);
    }
}
