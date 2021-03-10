<?php

namespace App\Services\OrdersManagement\Features;

use Illuminate\Http\Request;
use Lucid\Units\Feature;
use Lucid\Domains\Http\Jobs\RespondWithJsonJob;
use Lucid\Domains\Http\Jobs\RespondWithJsonErrorJob;
use Lucid\Exceptions\InvalidInputException;

use App\Domains\Order\Jobs\SaveOrderJob;
use App\Domains\Order\Jobs\ValidateOrderInputJob;

class AddProductFeature extends Feature
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
        $validator = $this->run(new ValidateOrderInputJob($request->input(), $this->id));

        if ($validator->fails()) {
            return $this->run(RespondWithJsonErrorJob::class, [
                'message' => $validator->errors(),
                'status' => 422,
            ]);
        }

        $order = $this->run(SaveOrderJob::class, [
            'id' => $this->id,
            'prod_id' => $request->input('prod_id'),
            'quantity' => $request->input('quantity'),
        ]);

        return $this->run(RespondWithJsonJob::class, [
            'content' => $order,
            'status' => 200
        ]);
    }
}
