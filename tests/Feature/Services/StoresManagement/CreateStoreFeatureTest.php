<?php

namespace Tests\Feature\Services\StoresManagement;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Services\StoresManagement\Features\CreateStoreFeature;

class CreateStoreFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_store_feature()
    {
        $data = [
            'name' => str_repeat('a', 100),
            'address' => str_repeat('a', 1000),
            'url' => 'http://www.example.com',
        ];

        $response = $this->post('/api/stores', $data);

        $response->assertStatus(201);
        $this->assertDatabaseCount('stores', 1);
    }

    public function test_create_store_feature_fail()
    {
        $data = [
            'name' => str_repeat('a', 101),
            'address' => str_repeat('a', 1000),
            'url' => 'http://www.example.com',
        ];

        $response = $this->post('/api/stores', $data);

        $response->assertStatus(422);
        $this->assertDatabaseCount('stores', 0);
    }
}
