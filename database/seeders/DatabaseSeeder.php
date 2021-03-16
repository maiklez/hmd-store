<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Services\ProductsManagement\database\seeds\ProductsTableSeeder;
use App\Services\AttributesManagement\database\seeds\AttributesTableSeeder;
use App\Services\ProductAttributesManagement\database\seeds\ProductAttributesTableSeeder;
use App\Services\CategoriesManagement\database\seeds\CategoriesTableSeeder;
use App\Services\ProvidersManagement\database\seeds\ProvidersTableSeeder;
use App\Services\StoresManagement\database\seeds\StoresTableSeeder;
use App\Services\ClientsManagement\database\seeds\ClientsTableSeeder;
use App\Services\OrdersManagement\database\seeds\OrdersTableSeeder;

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

        //$this->call(CategoriesTableSeeder::class);
        //$this->call(ProvidersTableSeeder::class);
        //$this->call(AttributesTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        //$this->call(ProductAttributesTableSeeder::class);
        $this->call(OrdersTableSeeder::class);

        // Re enable all mass assignment restrictions
        Model::reguard();
    }
}
