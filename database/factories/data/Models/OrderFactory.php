<?php

namespace Database\Factories\data\Models;

use App\Data\Models\Order;
use App\Data\Models\Client;
use App\Data\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'client_id' => Client::factory(),
            'store_id' => Store::factory(),
        ];
    }
}
