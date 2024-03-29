<?php

namespace App\Services\StoresManagement\Http\Controllers;

use Lucid\Units\Controller;
use App\Services\StoresManagement\Features\ListStoresFeature;
use App\Services\StoresManagement\Features\CreateStoreFeature;
use App\Services\StoresManagement\Features\ReadStoreFeature;
use App\Services\StoresManagement\Features\UpdateStoreFeature;
use App\Services\StoresManagement\Features\DeleteStoreFeature;
use App\Services\StoresManagement\Features\ListStoresTopSellersFeature;
use App\Services\StoresManagement\Features\ListStoresTopBillingFeature;

class StoreController extends Controller
{

    public function getStores()
    {
        return $this->serve(ListStoresFeature::class);
    }

    public function topSellers()
    {
        return $this->serve(ListStoresTopSellersFeature::class);
    }

    public function topBilling()
    {
        return $this->serve(ListStoresTopBillingFeature::class);
    }

    public function createStore()
    {
        return $this->serve(CreateStoreFeature::class);
    }

    public function readStore($id)
    {
        return $this->serve(ReadStoreFeature::class, [ 'id' => $id]);
    }

    public function updateStore($id)
    {
        return $this->serve(UpdateStoreFeature::class, [ 'id' => $id]);
    }

    public function deleteStore($id)
    {
        return $this->serve(DeleteStoreFeature::class, [ 'id' => $id]);
    }
}
