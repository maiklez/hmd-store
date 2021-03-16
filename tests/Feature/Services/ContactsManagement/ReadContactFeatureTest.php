<?php

namespace Tests\Feature\Services\ContactsManagement;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Services\ContactsManagement\Features\ReadContactFeature;
use App\Data\Models\Contact;

class ReadContactFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_read_contact_feature()
    {

        $contacts = Contact::factory(1)->create();

        $response = $this->get('/api/contacts/1');

        $response
            ->assertStatus(200)
            ->assertJson([
                'status' => 200,
                'data' => []
            ]);

        $this->assertDatabaseCount('contacts', 1);
    }

    public function test_read_contact_feature_fail()
    {
        $response = $this->get('/api/contacts/1');

        $response->assertStatus(404);
        $this->assertDatabaseCount('contacts', 0);
    }
}
