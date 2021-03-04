<?php

namespace App\Services\ProvidersManagement\Features;

use Illuminate\Http\Request;
use Lucid\Units\Feature;
use Lucid\Domains\Http\Jobs\RespondWithJsonJob;

use App\Domains\Provider\Jobs\ReadProviderJob;

class ListProvidersFeature extends Feature
{
    public function handle(Request $request)
    {
        $providers = $this->run(ReadProviderJob::class);

        return $this->run(new RespondWithJsonJob($providers));
    }
}
