<?php

namespace Tests\Feature\Services\CategoriesManagement;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Services\CategoriesManagement\Features\ListCategoriesFeature;
use App\Data\Models\Category;

class ListCategoriesFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_list_categories_feature()
    {
        $categories = Category::factory(15)->create();

        $response = $this->get('/api/categories');

        $response
            ->assertStatus(200)
            ->assertJson([
                'status' => 200,
                'data' => []
            ])
            ->assertJsonCount(15, 'data');
    }
}
