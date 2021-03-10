<?php

namespace Tests\Feature\Services\ClientsManagement;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Services\ClientsManagement\Features\CreateClientFeature;

class CreateClientFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_client_feature()
    {
        $data = [
            'name' => str_repeat('a', 100),
            'email' => 'test@test.es',
        ];

        $response = $this->post('/api/clients', $data);

        $response->assertStatus(201);
        $this->assertDatabaseCount('clients', 1);
    }

    public function test_create_client_feature_fail()
    {
        $data = [
            'name' => str_repeat('a', 101),
            'email' => 'test@',
        ];

        $response = $this->post('/api/clients', $data);

        $response->assertStatus(422);
        $this->assertDatabaseCount('clients', 0);
    }
}
