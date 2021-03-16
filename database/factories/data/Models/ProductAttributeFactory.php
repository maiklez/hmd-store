<?php

namespace Database\Factories\data\Models;

use App\Data\Models\ProductAttribute;
use App\Data\Models\Product;
use App\Data\Models\Attribute;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductAttributeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductAttribute::class;

    public function fakeValue()
    {
        return $this->faker->word;
    }

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'prod_id' => Product::factory(),
            'type' => Attribute::factory(),
            'value' => $this->faker->word,
        ];
    }
}
