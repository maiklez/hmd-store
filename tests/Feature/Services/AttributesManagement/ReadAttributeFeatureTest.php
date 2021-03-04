<?php

namespace Tests\Feature\Services\AttributesManagement;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Services\AttributesManagement\Features\ReadAttributeFeature;
use App\Data\Models\Attribute;

class ReadAttributeFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_read_attribute_feature()
    {

        $attributes = Attribute::factory(1)->create();

        $response = $this->get('/api/attributes/1');

        $response
            ->assertStatus(200)
            ->assertJson([
                'status' => 200,
                'data' => []
            ]);

        $this->assertDatabaseCount('attributes', 1);
    }

    public function test_read_attribute_feature_fail()
    {
        $response = $this->get('/api/attributes/1');

        $response->assertStatus(404);
        $this->assertDatabaseCount('attributes', 0);
    }
}
