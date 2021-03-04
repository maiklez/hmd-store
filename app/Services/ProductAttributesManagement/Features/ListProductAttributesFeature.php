<?php

namespace App\Services\ProductAttributesManagement\Features;

use Illuminate\Http\Request;
use Lucid\Units\Feature;
use Lucid\Domains\Http\Jobs\RespondWithJsonJob;

use App\Domains\ProductAttribute\Jobs\ReadProductAttributeJob;

class ListProductAttributesFeature extends Feature
{
    public function handle(Request $request)
    {
        $productattributes = $this->run(ReadProductAttributeJob::class);

        return $this->run(new RespondWithJsonJob($productattributes));
    }
}
