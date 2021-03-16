<?php

namespace Tests\Feature\Services\ProvidersManagement;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Services\ProvidersManagement\Features\CreateProviderFeature;

class CreateProviderFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_provider_feature()
    {
        $data = [
            'name' => str_repeat('a', 100),
            'cif' => str_repeat('a', 9),
            'name' => str_repeat('a', 100),
            'email' => 'test@test.com',
            'phone' => '0034600606060',
        ];

        $response = $this->post('/api/providers', $data);

        $response->assertStatus(201);
        $this->assertDatabaseCount('providers', 1);
        $this->assertDatabaseCount('contacts', 1);
    }

    public function test_create_provider_feature_fail()
    {
        $data = [
            'cif' => str_repeat('a', 9),
            'name' => str_repeat('a', 100),
            'email' => 'test@test.com',
        ];

        $response = $this->post('/api/providers', $data);

        $response->assertStatus(422);
        $this->assertDatabaseCount('providers', 0);
    }
}
