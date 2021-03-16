<?php

namespace Tests\Feature\Services\ProductsManagement;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Services\ProductsManagement\Features\ListProductsFeature;
use App\Data\Models\Product;
use App\Data\Models\Attribute;
use App\Data\Models\ProductAttribute;
use Database\Factories\data\Models\ProductFactory;
class ListProductsFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_list_products_feature()
    {
        $products = Product::factory(15)->create();

        $response = $this->get('/api/products');

        $response
            ->assertStatus(200)
            ->assertJson([
                'status' => 200,
                'data' => []
            ])
            ->assertJsonCount(15, 'data');
    }

    public function test_list_products_best_sellers_feature()
    {
        //$factory = new ProductFactory();
        Product::factory()->testProductsStores();

        $response = $this->get('/api/products/orders/best-sellers');

        $response
            ->assertStatus(200)
            ->assertJson([
                'status' => 200,
                'data' => []
            ])
            ->assertJsonCount(1, 'data');
    }

    public function test_list_products_attributes_feature()
    {
        $products = Product::factory(15)
            ->hasAttached(
                Attribute::factory()->count(3),
                function (Product $attr) {
                        return ['value' => ProductAttribute::factory()->fakeValue()];
                    }
            )
            ->create();

        $prodAttr = $products[0]->productAttributes()->get();

        $response = $this->get('/api/products/types/'. $prodAttr[0]->type .'/values/'. $prodAttr[0]->value);

        $response
            ->assertStatus(200)
            ->assertJson([
                'status' => 200,
                'data' => []
            ])
            ->assertJsonCount(1, 'data');
    }
}
