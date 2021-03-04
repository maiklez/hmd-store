<?php

namespace Tests\Feature\Services\ProductAttributesManagement;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Services\ProductAttributesManagement\Features\UpdateProductAttributeFeature;
use App\Data\Models\ProductAttribute;
use App\Data\Models\Product;
use App\Data\Models\Attribute;

class UpdateProductAttributeFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_update_productattribute_feature()
    {
        $products = Product::factory()
            ->hasAttached(
                Attribute::factory()->count(1),
                ['value' => 'asdasdas']
            )
            ->create();

        $data = [
            'value' => str_repeat('a', 100),
        ];

        $response = $this->put('/api/product-attributes/1', $data);

        $response->assertStatus(200);
        $this->assertDatabaseCount('product_attributes', 1);
    }

    public function test_update_productattribute_feature_fail_422()
    {
        $products = Product::factory()
            ->hasAttached(
                Attribute::factory()->count(1),
                ['value' => 'asdasdas']
            )
            ->create();

        $data = [
            'value' => str_repeat('a', 101),
        ];

        $response = $this->put('/api/product-attributes/1', $data);

        $response->assertStatus(422);
    }

    public function test_update_productattribute_feature_fail_404()
    {
        $data = [
            'value' => str_repeat('a', 100),
        ];

        $response = $this->put('/api/product-attributes/1', $data);

        $response->assertStatus(404);
        $this->assertDatabaseCount('product_attributes', 0);
    }
}
