<?php

namespace Database\Factories\data\Models;

use App\Data\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->name;
        $slug = $name;

        return [
            'name' => $name,
            'slug' => $slug,
            'description' => $this->faker->text,
            'price' => $this->faker->randomFloat(1, 0, 9999999),
        ];
    }
}
