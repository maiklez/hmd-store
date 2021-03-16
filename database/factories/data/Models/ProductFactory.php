<?php

namespace Database\Factories\data\Models;

use App\Data\Models\Product;
use App\Data\Models\Store;
use App\Data\Models\Order;
use App\Data\Models\Provider;
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
        $slug = Str::slug($name, '-');

        return [
            'name' => $name,
            'slug' => $slug,
            'description' => $this->faker->text,
            'price' => $this->faker->randomFloat(2, 0, 9999999),
        ];
    }

    public function testProductsStores()
    {
        $products = Product::factory(15)
                ->hasAttached(
                    Store::factory()->has(
                        Order::factory()
                    )->count(5)
                )
                ->hasAttached(
                    Provider::factory()
                )
                ->create();

        $orders = Order::all();
        foreach ($orders as $order)
        {
            $product = Product::with([
                'stores' => function ($query)  use ($order){
                    $query->where('product_stores.store_id', '=', $order->store_id);
                },
            ])->first();

            $order->products()->attach(
                $product->id, ['quantity' => Order::factory()->quantity()]
            );
        }

        return $products;
    }
}
