<?php

namespace App\Services\StoresManagement\database\seeds;

use App\Services\StoresManagement\Database\Factories\StoreFactory;
use Illuminate\Database\Seeder;
use App\Data\Models\Store;

class StoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Store::factory(15)->create();
    }
}
