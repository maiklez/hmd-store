<?php

namespace App\Services\ProductsManagement\Features;

use Illuminate\Http\Request;
use Lucid\Units\Feature;
use Lucid\Domains\Http\Jobs\RespondWithJsonJob;
use Lucid\Domains\Http\Jobs\RespondWithJsonErrorJob;
use Lucid\Exceptions\InvalidInputException;

use App\Domains\Product\Jobs\SaveProductJob;
use App\Domains\Product\Jobs\ValidateProductInputJob;

class UpdateProductFeature extends Feature
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
        $validator = $this->run(new ValidateProductInputJob($request->input(), $this->id));

        if ($validator->fails()) {
            return $this->run(RespondWithJsonErrorJob::class, [
                'message' => $validator->errors(),
                'status' => 422,
            ]);
        }

        $product = $this->run(SaveProductJob::class, [
            'id' => $this->id,
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),
            // 'provider' => $request->input('provider'),
        ]);

        return $this->run(RespondWithJsonJob::class, [
            'content' => $product,
            'status' => 200
        ]);
    }
}
