<?php

namespace App\Services\CategoriesManagement\database\seeds;

use App\Services\CategoriesManagement\Database\Factories\CategoryFactory;
use Illuminate\Database\Seeder;
use App\Data\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::factory(15)->create();
    }
}
