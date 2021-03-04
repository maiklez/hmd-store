<?php

namespace App\Services\ProvidersManagement\Http\Controllers;

use Lucid\Units\Controller;
use App\Services\ProvidersManagement\Features\ListProvidersFeature;
use App\Services\ProvidersManagement\Features\CreateProviderFeature;
use App\Services\ProvidersManagement\Features\ReadProviderFeature;
use App\Services\ProvidersManagement\Features\UpdateProviderFeature;
use App\Services\ProvidersManagement\Features\DeleteProviderFeature;

class ProviderController extends Controller
{

    public function getProviders()
    {
        return $this->serve(ListProvidersFeature::class);
    }

    public function createProvider()
    {
        return $this->serve(CreateProviderFeature::class);
    }

    public function readProvider($id)
    {
        return $this->serve(ReadProviderFeature::class, [ 'id' => $id]);
    }

    public function updateProvider($id)
    {
        return $this->serve(UpdateProviderFeature::class, [ 'id' => $id]);
    }

    public function deleteProvider($id)
    {
        return $this->serve(DeleteProviderFeature::class, [ 'id' => $id]);
    }
}
