<?php

namespace App\Services\ProvidersManagement\Features;

use Illuminate\Http\Request;
use Lucid\Units\Feature;
use Lucid\Domains\Http\Jobs\RespondWithJsonJob;

use App\Domains\Provider\Jobs\ReadProviderTopBillingJob;

class ListProvidersTopBillingFeature extends Feature
{
    public function handle(Request $request)
    {
        $providers = $this->run(ReadProviderTopBillingJob::class);

        return $this->run(new RespondWithJsonJob($providers));
    }
}
