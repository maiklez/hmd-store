<?php

namespace App\Services\StoresManagement\Features;

use Illuminate\Http\Request;
use Lucid\Units\Feature;
use Lucid\Domains\Http\Jobs\RespondWithJsonJob;

use App\Domains\Store\Jobs\ReadStoreJob;

class ListStoresFeature extends Feature
{
    public function handle(Request $request)
    {
        $stores = $this->run(ReadStoreJob::class);

        return $this->run(new RespondWithJsonJob($stores));
    }
}
