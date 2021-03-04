<?php

namespace App\Services\AttributesManagement\Features;

use Illuminate\Http\Request;
use Lucid\Units\Feature;
use Lucid\Domains\Http\Jobs\RespondWithJsonJob;

use App\Domains\Attribute\Jobs\ReadAttributeJob;

class ListAttributesFeature extends Feature
{
    public function handle(Request $request)
    {
        $attributes = $this->run(ReadAttributeJob::class);

        return $this->run(new RespondWithJsonJob($attributes));
    }
}
