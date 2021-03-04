<?php

namespace Tests\Feature\Services\StoresManagement;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Services\StoresManagement\Features\ListStoresFeature;
use App\Data\Models\Store;

class ListStoresFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_list_stores_feature()
    {
        $stores = Store::factory(15)->create();

        $response = $this->get('/api/stores');

        $response
            ->assertStatus(200)
            ->assertJson([
                'status' => 200,
                'data' => []
            ])
            ->assertJsonCount(15, 'data');
    }
}
