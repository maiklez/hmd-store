<?php

namespace App\Services\ProductsManagement\Features;

use Illuminate\Http\Request;
use Lucid\Units\Feature;
use Lucid\Domains\Http\Jobs\RespondWithJsonJob;
use Lucid\Domains\Http\Jobs\RespondWithJsonErrorJob;
use Lucid\Exceptions\InvalidInputException;

use App\Domains\Product\Jobs\ReadProductBestSellersJob;

class ListProductBestSellersFeature extends Feature
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
        $products = $this->run(ReadProductBestSellersJob::class, [
            'store_id' => $request->query('store_id'),
        ]);

        return $this->run(RespondWithJsonJob::class, [
            'content' => $products,
            'status' => 200
        ]);
    }
}
