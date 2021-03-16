<?php

namespace Tests\Feature\Services\ContactsManagement;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Services\ContactsManagement\Features\ListContactsFeature;
use App\Data\Models\Contact;
use Database\Factories\data\Models\ProductFactory;

class ListContactsFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_list_contacts_feature()
    {
        $contacts = Contact::factory(15)->create();

        $response = $this->get('/api/contacts');

        $response
            ->assertStatus(200)
            ->assertJson([
                'status' => 200,
                'data' => []
            ])
            ->assertJsonCount(15, 'data');
    }

}
