<?php

namespace App\Services\OrdersManagement\database\seeds;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Builder;
use App\Data\Models\Order;
use App\Data\Models\Product;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $orders = Order::all();
        foreach ($orders as $order)
        {
            $product = Product::with([
                'stores' => function ($query)  use ($order){
                    $query->where('product_stores.store_id', '=', $order->store_id);
                },
            ])->first();

            $order->products()->attach(
                $product->id, ['quantity' => 2]
            );
        }
    }
}
