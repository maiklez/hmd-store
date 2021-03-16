<?php

namespace Tests\Feature\Services\ContactsManagement;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Services\ContactsManagement\Features\CreateContactFeature;
use App\Data\Models\Store;
use App\Data\Models\Provider;

class CreateContactFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_contact_store_feature()
    {
        $store = Store::factory(1)->create();
        $data = [
            'name' => str_repeat('a', 100),
            'email' => 'test@test.es',
            'phone' => '0034600606060',
            'type' => 'Store',
            'related_id' => $store[0]->id,
        ];

        $response = $this->post('/api/contacts', $data);

        $response->assertStatus(201);
        $this->assertDatabaseCount('contacts', 1);
    }

    public function test_create_contact_provider_feature()
    {
        $provider = Provider::factory(1)->create();
        $data = [
            'name' => str_repeat('a', 100),
            'email' => 'test@test.es',
            'phone' => '0034600606060',
            'type' => 'Provider',
            'related_id' => $provider[0]->id,
        ];

        $response = $this->post('/api/contacts', $data);

        $response->assertStatus(201);
        $this->assertDatabaseCount('contacts', 1);
    }

    public function test_create_contact_feature_fail()
    {
        $data = [
            'name' => str_repeat('a', 101),
            'email' => 'test@',
        ];

        $response = $this->post('/api/contacts', $data);

        $response->assertStatus(422);
        $this->assertDatabaseCount('contacts', 0);
    }
}
