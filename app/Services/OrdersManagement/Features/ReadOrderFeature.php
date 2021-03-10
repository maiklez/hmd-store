<?php

namespace App\Services\OrdersManagement\Features;

use Illuminate\Http\Request;
use Lucid\Units\Feature;
use Lucid\Domains\Http\Jobs\RespondWithJsonJob;
use Lucid\Domains\Http\Jobs\RespondWithJsonErrorJob;
use Lucid\Exceptions\InvalidInputException;

use App\Domains\Order\Jobs\ReadOrderJob;
use App\Domains\Order\Jobs\ValidateOrderInputJob;

class ReadOrderFeature extends Feature
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
        $order = $this->run(ReadOrderJob::class, [
            'id' => $this->id,
        ]);

        return $this->run(RespondWithJsonJob::class, [
            'content' => $order,
            'status' => 200
        ]);
    }
}
