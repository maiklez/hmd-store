<?php

namespace Tests\Feature\Services\AttributesManagement;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Services\AttributesManagement\Features\UpdateAttributeFeature;
use App\Data\Models\Attribute;

class UpdateAttributeFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_update_attribute_feature()
    {
        $attributes = Attribute::factory(1)->create();

        $data = [
            'name' => str_repeat('a', 100),
            'slug' => str_repeat('a', 50),
            'description' => str_repeat('a', 255),
        ];

        $response = $this->put('/api/attributes/1', $data);

        $response->assertStatus(200);
        $this->assertDatabaseCount('attributes', 1);
    }

    public function test_update_attribute_feature_fail_422()
    {
        $attributes = Attribute::factory(2)->create();

        $data = [
            'name' => str_repeat('a', 100),
            'slug' => $attributes[0]->slug,
            'description' => str_repeat('a', 255),
        ];

        $response = $this->put('/api/attributes/2', $data);

        $response->assertStatus(422);
    }

    public function test_update_attribute_feature_fail_404()
    {
        $data = [
            'name' => str_repeat('a', 100),
            'slug' => str_repeat('a', 50),
            'description' => str_repeat('a', 255),
        ];

        $response = $this->put('/api/attributes/1', $data);

        $response->assertStatus(404);
        $this->assertDatabaseCount('attributes', 0);
    }
}
