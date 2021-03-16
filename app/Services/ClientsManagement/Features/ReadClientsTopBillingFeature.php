<?php

namespace App\Services\ClientsManagement\Features;

use Illuminate\Http\Request;
use Lucid\Units\Feature;
use Lucid\Domains\Http\Jobs\RespondWithJsonJob;
use Lucid\Domains\Http\Jobs\RespondWithJsonErrorJob;
use App\Domains\Client\Jobs\ReadClientsTopBillingJob;

class ReadClientsTopBillingFeature extends Feature
{
    /**
     * Create a new feature instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function handle(Request $request)
    {
        $client = $this->run(ReadClientsTopBillingJob::class);

        return $this->run(RespondWithJsonJob::class, [
            'content' => $client,
            'status' => 200
        ]);
    }
}
