<?php

namespace App\Services\StoresManagement\Features;

use Illuminate\Http\Request;
use Lucid\Units\Feature;
use Lucid\Domains\Http\Jobs\RespondWithJsonJob;
use Lucid\Domains\Http\Jobs\RespondWithJsonErrorJob;
use Lucid\Exceptions\InvalidInputException;

use App\Domains\Store\Jobs\SaveStoreJob;
use App\Domains\Store\Jobs\ValidateStoreInputJob;

class UpdateStoreFeature extends Feature
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
        $validator = $this->run(new ValidateStoreInputJob($request->input(), $this->id));

        if ($validator->fails()) {
            return $this->run(RespondWithJsonErrorJob::class, [
                'message' => $validator->errors(),
                'status' => 422,
            ]);
        }

        $store = $this->run(SaveStoreJob::class, [
            'id' => $this->id,
            'name' => $request->input('name'),
            'address' => $request->input('address'),
            'url' => $request->input('url'),
        ]);

        return $this->run(RespondWithJsonJob::class, [
            'content' => $store,
            'status' => 200
        ]);
    }
}
