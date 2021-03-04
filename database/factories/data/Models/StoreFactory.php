<?php

namespace Database\Factories\data\Models;

use App\Data\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class StoreFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Store::class;

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
            'address' => $slug,
            'url' => $this->faker->url,
        ];
    }
}
