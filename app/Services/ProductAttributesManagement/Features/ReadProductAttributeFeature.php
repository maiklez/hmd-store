<?php

namespace App\Services\ProductAttributesManagement\Features;

use Illuminate\Http\Request;
use Lucid\Units\Feature;
use Lucid\Domains\Http\Jobs\RespondWithJsonJob;
use Lucid\Domains\Http\Jobs\RespondWithJsonErrorJob;
use Lucid\Exceptions\InvalidInputException;

use App\Domains\ProductAttribute\Jobs\ReadProductAttributeJob;
use App\Domains\ProductAttribute\Jobs\ValidateProductAttributeInputJob;

class ReadProductAttributeFeature extends Feature
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
        $productattribute = $this->run(ReadProductAttributeJob::class, [
            'id' => $this->id,
        ]);

        return $this->run(RespondWithJsonJob::class, [
            'content' => $productattribute,
            'status' => 200
        ]);
    }
}
