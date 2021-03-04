<?php

namespace App\Services\ProductAttributesManagement\Features;

use Illuminate\Http\Request;
use Lucid\Units\Feature;
use Lucid\Domains\Http\Jobs\RespondWithJsonJob;
use Lucid\Domains\Http\Jobs\RespondWithJsonErrorJob;
use Lucid\Exceptions\InvalidInputException;

use App\Domains\ProductAttribute\Jobs\SaveProductAttributeJob;
use App\Domains\ProductAttribute\Jobs\ValidateProductAttributeInputJob;

class CreateProductAttributeFeature extends Feature
{
    public function handle(Request $request)
    {
        $validator = $this->run(new ValidateProductAttributeInputJob($request->input()));

        if ($validator->fails()) {
            return $this->run(RespondWithJsonErrorJob::class, [
                'message' => $validator->errors(),
                'status' => 422,
            ]);
        }

        $productattribute = $this->run(SaveProductAttributeJob::class, [
            'prod_id' => $request->input('prod_id'),
            'type' => $request->input('type'),
            'value' => $request->input('value'),
        ]);

        return $this->run(RespondWithJsonJob::class, [
            'content' => $productattribute,
            'status' => 201
        ]);
    }
}
