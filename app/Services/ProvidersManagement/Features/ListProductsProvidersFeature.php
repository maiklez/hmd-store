<?php

namespace App\Services\ProvidersManagement\Features;

use Illuminate\Http\Request;
use Lucid\Units\Feature;
use Lucid\Domains\Http\Jobs\RespondWithJsonJob;

use App\Domains\Provider\Jobs\ReadProductProvidersJob;

class ListProductsProvidersFeature extends Feature
{
    /**
     * Create a new feature instance.
     *
     * @return void
     */
    public function __construct($id = null)
    {
        $this->id = $id;
    }

    public function handle(Request $request)
    {
        $products = $this->run(ReadProductProvidersJob::class, [
            'id' => $this->id,
        ]);

        return $this->run(new RespondWithJsonJob($products));
    }
}
