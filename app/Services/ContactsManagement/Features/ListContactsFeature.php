<?php

namespace App\Services\ContactsManagement\Features;

use Illuminate\Http\Request;
use Lucid\Units\Feature;
use Lucid\Domains\Http\Jobs\RespondWithJsonJob;

use App\Domains\Contact\Jobs\ReadContactJob;

class ListContactsFeature extends Feature
{
    public function handle(Request $request)
    {
        $contacts = $this->run(ReadContactJob::class);

        return $this->run(new RespondWithJsonJob($contacts));
    }
}
