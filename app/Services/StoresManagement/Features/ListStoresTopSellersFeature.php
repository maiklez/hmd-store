<?php

namespace App\Services\StoresManagement\Features;

use Illuminate\Http\Request;
use Lucid\Units\Feature;
use Lucid\Domains\Http\Jobs\RespondWithJsonJob;

use App\Domains\Store\Jobs\ReadStoreTopSellerJob;

class ListStoresTopSellersFeature extends Feature
{
    public function handle(Request $request)
    {
        $stores = $this->run(ReadStoreTopSellerJob::class);

        return $this->run(new RespondWithJsonJob($stores));
    }
}
