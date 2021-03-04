<?php

namespace App\Services\ProductsManagement\database\seeds;

use App\Services\ProductsManagement\Database\Factories\ProductFactory;
use Illuminate\Database\Seeder;
use App\Data\Models\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::factory(15)->create();
    }
}
