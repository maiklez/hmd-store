<?php

namespace Tests\Feature\Services\ProvidersManagement;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Services\ProvidersManagement\Features\ReadProviderFeature;
use App\Data\Models\Provider;

class ReadProviderFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_read_provider_feature()
    {

        $providers = Provider::factory(1)->create();

        $response = $this->get('/api/providers/1');

        $response
            ->assertStatus(200)
            ->assertJson([
                'status' => 200,
                'data' => []
            ]);

        $this->assertDatabaseCount('providers', 1);
    }

    public function test_read_provider_feature_fail()
    {
        $response = $this->get('/api/providers/1');

        $response->assertStatus(404);
        $this->assertDatabaseCount('providers', 0);
    }
}
