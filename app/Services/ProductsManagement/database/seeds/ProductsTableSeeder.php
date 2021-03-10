<?php

namespace App\Services\ProductsManagement\database\seeds;

use App\Services\ProductsManagement\Database\Factories\ProductFactory;
use Illuminate\Database\Seeder;
use App\Data\Models\Product;
use App\Data\Models\StoreProduct;
use App\Data\Models\Category;
use App\Data\Models\Provider;
use App\Data\Models\Store;
use App\Data\Models\Order;
class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Product::factory(15)
            ->hasAttached(
                Category::factory()->count(5)
            )
            ->hasAttached(
                Provider::factory()->count(5)
            )
            ->hasAttached(
                Store::factory()->has(
                    Order::factory()->count(1)
                )->count(5)
            )
            ->create();

    }
}
