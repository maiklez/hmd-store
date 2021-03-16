<?php

namespace App\Services\OrdersManagement\Features;

use Illuminate\Http\Request;
use Lucid\Units\Feature;
use Lucid\Domains\Http\Jobs\RespondWithJsonJob;

use App\Domains\Order\Jobs\ReadOrderJob;

class ListOrdersFeature extends Feature
{
    public function handle(Request $request)
    {
        $orders = $this->run(ReadOrderJob::class, [
            'storeId' => $request->query('store_id'),
            'dateIni' => $request->query('date_ini'),
            'dateEnd' => $request->query('date_end'),
        ]);

        return $this->run(new RespondWithJsonJob($orders));
    }
}
