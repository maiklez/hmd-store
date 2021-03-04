<?php

namespace Tests\Feature\Services\ProductAttributesManagement;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Services\ProductAttributesManagement\Features\ReadProductAttributeFeature;
use App\Data\Models\ProductAttribute;
use App\Data\Models\Product;
use App\Data\Models\Attribute;

class ReadProductAttributeFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_read_productattribute_feature()
    {
        $products = Product::factory()
            ->hasAttached(
                Attribute::factory()->count(1),
                ['value' => 'asdasdas']
            )
            ->create();

        $response = $this->get('/api/product-attributes/1');

        $response
            ->assertStatus(200)
            ->assertJson([
                'status' => 200,
                'data' => []
            ]);

        $this->assertDatabaseCount('product_attributes', 1);
    }

    public function test_read_productattribute_feature_fail()
    {
        $response = $this->get('/api/product-attributes/1');

        $response->assertStatus(404);
        $this->assertDatabaseCount('product_attributes', 0);
    }
}
