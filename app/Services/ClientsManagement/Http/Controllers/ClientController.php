<?php

namespace App\Services\ClientsManagement\Http\Controllers;

use Lucid\Units\Controller;
use App\Services\ClientsManagement\Features\ListClientsFeature;
use App\Services\ClientsManagement\Features\CreateClientFeature;
use App\Services\ClientsManagement\Features\ReadClientFeature;
use App\Services\ClientsManagement\Features\UpdateClientFeature;
use App\Services\ClientsManagement\Features\DeleteClientFeature;

class ClientController extends Controller
{

    public function getClients()
    {
        return $this->serve(ListClientsFeature::class);
    }

    public function createClient()
    {
        return $this->serve(CreateClientFeature::class);
    }

    public function readClient($id)
    {
        return $this->serve(ReadClientFeature::class, [ 'id' => $id]);
    }

    public function updateClient($id)
    {
        return $this->serve(UpdateClientFeature::class, [ 'id' => $id]);
    }

    public function deleteClient($id)
    {
        return $this->serve(DeleteClientFeature::class, [ 'id' => $id]);
    }
}
