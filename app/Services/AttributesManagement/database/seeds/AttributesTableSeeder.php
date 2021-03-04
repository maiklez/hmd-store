<?php

namespace App\Services\AttributesManagement\database\seeds;

use App\Services\AttributesManagement\Database\Factories\AttributeFactory;
use Illuminate\Database\Seeder;
use App\Data\Models\Attribute;

class AttributesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Attribute::factory(15)->create();
    }
}
