<?php

namespace Tests\Feature\Services\ContactsManagement;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Services\ContactsManagement\Features\UpdateContactFeature;
use App\Data\Models\Contact;

class UpdateContactFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_update_contact_feature()
    {
        $contacts = Contact::factory(1)->create();

        $data = [
            'name' => str_repeat('a', 100),
            'email' => 'test@test.es',
            'phone' => '1600606060',
        ];

        $response = $this->put('/api/contacts/1', $data);

        $response->assertStatus(200);
        $this->assertDatabaseCount('contacts', 1);
    }

    public function test_update_contact_feature_fail_422()
    {
        $contacts = Contact::factory(2)->create();

        $data = [
            'name' => str_repeat('a', 100),
            'email' => 'test@test.es',
        ];

        $response = $this->put('/api/contacts/2', $data);
        $response->assertStatus(422);
    }

    public function test_update_contact_feature_fail_404()
    {
        $data = [
            'name' => str_repeat('a', 100),
            'email' => 'test@test.es',
            'phone' => '0034600606060',
        ];

        $response = $this->put('/api/contacts/1', $data);

        $response->assertStatus(404);
        $this->assertDatabaseCount('contacts', 0);
    }
}
