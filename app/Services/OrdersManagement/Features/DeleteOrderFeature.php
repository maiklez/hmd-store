<?php

namespace App\Services\OrdersManagement\Features;

use Illuminate\Http\Request;
use Lucid\Units\Feature;
use Lucid\Domains\Http\Jobs\RespondWithJsonJob;
use Lucid\Domains\Http\Jobs\RespondWithJsonErrorJob;
use Lucid\Exceptions\InvalidInputException;

use App\Domains\Order\Jobs\DeleteOrderJob;
use App\Domains\Order\Jobs\ValidateOrderInputJob;

class DeleteOrderFeature extends Feature
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
        $order = $this->run(DeleteOrderJob::class, [
            'id' => $this->id,
        ]);

        return $this->run(RespondWithJsonJob::class, [
            'content' => $order,
            'status' => 204
        ]);
    }
}
