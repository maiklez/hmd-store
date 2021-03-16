<?php

namespace App\Services\StoresManagement\Features;

use Illuminate\Http\Request;
use Lucid\Units\Feature;
use Lucid\Domains\Http\Jobs\RespondWithJsonJob;

use App\Domains\Store\Jobs\ReadStoreTopBillingJob;

class ListStoresTopBillingFeature extends Feature
{
    public function handle(Request $request)
    {
        $stores = $this->run(ReadStoreTopBillingJob::class, [
            'store_id' => $request->query('store_id'),
        ]);

        return $this->run(new RespondWithJsonJob($stores));
    }
}
