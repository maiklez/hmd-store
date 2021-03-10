<?php

namespace App\Services\ProductAttributesManagement\database\seeds;

use App\Services\ProductAttributesManagement\Database\Factories\ProductAttributeFactory;
use Illuminate\Database\Seeder;
use App\Data\Models\ProductAttribute;

class ProductAttributesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductAttribute::factory(15)->create();
    }
}
