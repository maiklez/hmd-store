<?php

namespace App\Services\ClientsManagement\Features;

use Illuminate\Http\Request;
use Lucid\Units\Feature;
use Lucid\Domains\Http\Jobs\RespondWithJsonJob;

use App\Domains\Client\Jobs\ReadClientJob;

class ListClientsFeature extends Feature
{
    public function handle(Request $request)
    {
        $clients = $this->run(ReadClientJob::class);

        return $this->run(new RespondWithJsonJob($clients));
    }
}
