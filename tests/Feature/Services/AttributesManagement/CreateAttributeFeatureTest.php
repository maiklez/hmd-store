<?php

namespace Tests\Feature\Services\AttributesManagement;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Services\AttributesManagement\Features\CreateAttributeFeature;

class CreateAttributeFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_attribute_feature()
    {
        $data = [
            'name' => str_repeat('a', 100),
            'slug' => str_repeat('a', 50),
            'description' => str_repeat('a', 255),
        ];

        $response = $this->post('/api/attributes', $data);

        $response->assertStatus(201);
        $this->assertDatabaseCount('attributes', 1);
    }

    public function test_create_attribute_feature_fail()
    {
        $data = [
            'name' => str_repeat('a', 101),
            'slug' => str_repeat('a', 51),
            'description' => str_repeat('a', 256),
        ];

        $response = $this->post('/api/attributes', $data);

        $response->assertStatus(422);
        $this->assertDatabaseCount('attributes', 0);
    }
}
