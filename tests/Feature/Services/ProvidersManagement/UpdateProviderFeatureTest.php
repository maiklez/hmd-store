<?php

namespace Tests\Feature\Services\ProvidersManagement;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Services\ProvidersManagement\Features\UpdateProviderFeature;
use App\Data\Models\Provider;

class UpdateProviderFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_update_provider_feature()
    {
        $providers = Provider::factory(1)->create();

        $data = [
            'name' => str_repeat('a', 100),
            'cif' => str_repeat('a', 9),
        ];

        $response = $this->put('/api/providers/1', $data);

        $response->assertStatus(200);
        $this->assertDatabaseCount('providers', 1);
    }

    public function test_update_provider_feature_fail_422()
    {
        $providers = Provider::factory(2)->create();

        $data = [
            'name' => str_repeat('a', 100),
            'cif' => $providers[0]->cif,
        ];

        $response = $this->put('/api/providers/2', $data);

        $response->assertStatus(422);
    }

    public function test_update_provider_feature_fail_404()
    {
        $data = [
            'name' => str_repeat('a', 100),
            'cif' => str_repeat('a', 9),
        ];

        $response = $this->put('/api/providers/1', $data);

        $response->assertStatus(404);
        $this->assertDatabaseCount('providers', 0);
    }
}
