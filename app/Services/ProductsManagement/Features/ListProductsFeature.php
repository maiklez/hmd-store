<?php

namespace App\Services\ProductsManagement\Features;

use Illuminate\Http\Request;
use Lucid\Units\Feature;
use Lucid\Domains\Http\Jobs\RespondWithJsonJob;

use App\Domains\Product\Jobs\ReadProductJob;

class ListProductsFeature extends Feature
{
    public function handle(Request $request)
    {
        $products = $this->run(ReadProductJob::class);

        return $this->run(new RespondWithJsonJob($products));
    }
}
