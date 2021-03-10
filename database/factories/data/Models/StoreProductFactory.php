<?php

namespace Database\Factories\data\Models;

use App\Data\Models\Store;
use App\Data\Models\StoreProduct;
use App\Data\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class StoreProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = StoreProduct::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'prod_id' => Product::factory(),
            'store_id' => Store::factory(),
        ];
    }
}
