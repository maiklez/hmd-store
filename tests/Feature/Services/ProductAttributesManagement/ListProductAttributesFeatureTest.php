<?php

namespace Tests\Feature\Services\ProductAttributesManagement;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Services\ProductAttributesManagement\Features\ListProductAttributesFeature;
use App\Data\Models\ProductAttribute;
use App\Data\Models\Product;
use App\Data\Models\Attribute;

class ListProductAttributesFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_list_productattributes_feature()
    {
        $products = Product::factory()
            ->hasAttached(
                Attribute::factory()->count(3),
                ['value' => 'asdasdas']
            )
            ->create();

        $response = $this->get('/api/product-attributes');

        $response
            ->assertStatus(200)
            ->assertJson([
                'status' => 200,
                'data' => []
            ])
            ->assertJsonCount(3, 'data');
    }
}
