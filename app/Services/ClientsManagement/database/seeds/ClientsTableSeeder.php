<?php

namespace App\Services\ClientsManagement\database\seeds;

use App\Services\ClientsManagement\Database\Factories\ClientFactory;
use Illuminate\Database\Seeder;
use App\Data\Models\Client;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Client::factory(15)->create();
    }
}
