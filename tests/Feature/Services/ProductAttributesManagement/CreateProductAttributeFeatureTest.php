<?php

namespace Tests\Feature\Services\ProductAttributesManagement;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Services\ProductAttributesManagement\Features\CreateProductAttributeFeature;
use App\Data\Models\Product;
use App\Data\Models\Attribute;

class CreateProductAttributeFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_productattribute_feature()
    {
        $product = Product::factory(1)->create();
        $attribute = Attribute::factory(1)->create();

        $data = [
            'prod_id' => $product[0]->id,
            'type' => $attribute[0]->slug,
            'value' => str_repeat('a', 100),
        ];

        $response = $this->post('/api/product-attributes', $data);

        $response->assertStatus(201);
        $this->assertDatabaseCount('product_attributes', 1);
    }

    public function test_create_productattribute_feature_fail()
    {
        $product = Product::factory(1)->create();
        $attribute = Attribute::factory(1)->create();

        $data = [
            'prod_id' => $product[0]->id,
            'type' => $attribute[0]->slug,
            'value' => str_repeat('a', 101),
        ];

        $response = $this->post('/api/product-attributes', $data);

        $response->assertStatus(422);
        $this->assertDatabaseCount('product_attributes', 0);
    }
}
