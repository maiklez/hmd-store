<?php

namespace Tests\Feature\Services\StoresManagement;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Services\StoresManagement\Features\UpdateStoreFeature;
use App\Data\Models\Store;

class UpdateStoreFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_update_store_feature()
    {
        $stores = Store::factory(1)->create();

        $data = [
            'name' => str_repeat('a', 100),
            'address' => str_repeat('a', 1000),
            'url' => 'http://www.example.com',
        ];

        $response = $this->put('/api/stores/1', $data);

        $response->assertStatus(200);
        $this->assertDatabaseCount('stores', 1);
    }

    public function test_update_store_feature_fail_422()
    {
        $stores = Store::factory(2)->create();

        $data = [
            'name' => str_repeat('a', 100),
            'address' => str_repeat('a', 1000),
            'url' => 'ttp://www.example.com',
        ];

        $response = $this->put('/api/stores/2', $data);

        $response->assertStatus(422);
    }

    public function test_update_store_feature_fail_404()
    {
        $data = [
            'name' => str_repeat('a', 100),
            'address' => str_repeat('a', 1000),
            'url' => 'http://www.example.com',
        ];

        $response = $this->put('/api/stores/1', $data);

        $response->assertStatus(404);
        $this->assertDatabaseCount('stores', 0);
    }
}
