<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Services\ProductsManagement\database\seeds\ProductsTableSeeder;
use App\Services\AttributesManagement\database\seeds\AttributesTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(ProductsTableSeeder::class);
        $this->call(AttributesTableSeeder::class);

        // Re enable all mass assignment restrictions
        Model::reguard();
    }
}
