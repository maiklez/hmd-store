<?php

namespace Tests\Feature\Services\AttributesManagement;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Services\AttributesManagement\Features\ListAttributesFeature;
use App\Data\Models\Attribute;

class ListAttributesFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_list_attributes_feature()
    {
        $attributes = Attribute::factory(15)->create();

        $response = $this->get('/api/attributes');

        $response
            ->assertStatus(200)
            ->assertJson([
                'status' => 200,
                'data' => []
            ])
            ->assertJsonCount(15, 'data');
    }
}
