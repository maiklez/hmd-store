<?php

namespace App\Services\ProvidersManagement\database\seeds;

use App\Services\ProvidersManagement\Database\Factories\ProviderFactory;
use Illuminate\Database\Seeder;
use App\Data\Models\Provider;

class ProvidersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Provider::factory(15)->create();
    }
}
