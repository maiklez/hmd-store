<?php

namespace Tests\Feature\Services\StoresManagement;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Services\StoresManagement\Features\ReadStoreFeature;
use App\Data\Models\Store;

class ReadStoreFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_read_store_feature()
    {

        $stores = Store::factory(1)->create();

        $response = $this->get('/api/stores/1');

        $response
            ->assertStatus(200)
            ->assertJson([
                'status' => 200,
                'data' => []
            ]);

        $this->assertDatabaseCount('stores', 1);
    }

    public function test_read_store_feature_fail()
    {
        $response = $this->get('/api/stores/1');

        $response->assertStatus(404);
        $this->assertDatabaseCount('stores', 0);
    }
}
