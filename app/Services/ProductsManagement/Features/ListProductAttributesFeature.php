<?php

namespace App\Services\ProductsManagement\Features;

use Illuminate\Http\Request;
use Lucid\Units\Feature;
use Lucid\Domains\Http\Jobs\RespondWithJsonJob;

use App\Domains\Product\Jobs\ListProductAttributesJob;

class ListProductAttributesFeature extends Feature
{
    /**
     * Create a new feature instance.
     *
     * @return void
     */
    public function __construct($type, $value)
    {
        $this->type = $type;
        $this->value = $value;
    }

    public function handle(Request $request)
    {
        $products = $this->run(ListProductAttributesJob::class, [
            'type' => $this->type,
            'value' => $this->value,
        ]);

        return $this->run(new RespondWithJsonJob($products));
    }
}
