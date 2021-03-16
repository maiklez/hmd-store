<?php

namespace Database\Factories\data\Models;

use App\Data\Models\Attribute;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AttributeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Attribute::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->name;
        $slug = Str::slug($name, '-');

        return [
            'name' => $name,
            'slug' => $slug,
            'description' => $this->faker->text,
        ];
    }
}
