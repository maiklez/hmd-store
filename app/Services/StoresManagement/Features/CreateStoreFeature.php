<?php

namespace App\Services\StoresManagement\Features;

use Illuminate\Http\Request;
use Lucid\Units\Feature;
use Lucid\Domains\Http\Jobs\RespondWithJsonJob;
use Lucid\Domains\Http\Jobs\RespondWithJsonErrorJob;
use Lucid\Exceptions\InvalidInputException;

use App\Domains\Store\Jobs\SaveStoreJob;
use App\Domains\Store\Jobs\ValidateStoreInputJob;

class CreateStoreFeature extends Feature
{
    public function handle(Request $request)
    {
        $validator = $this->run(new ValidateStoreInputJob($request->input()));

        if ($validator->fails()) {
            return $this->run(RespondWithJsonErrorJob::class, [
                'message' => $validator->errors(),
                'status' => 422,
            ]);
        }

        $store = $this->run(SaveStoreJob::class, [
            'name' => $request->input('name'),
            'address' => $request->input('address'),
            'url' => $request->input('url'),
        ]);

        return $this->run(RespondWithJsonJob::class, [
            'content' => $store,
            'status' => 201
        ]);
    }
}
