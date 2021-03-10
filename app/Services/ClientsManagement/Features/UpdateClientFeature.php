<?php

namespace App\Services\ClientsManagement\Features;

use Illuminate\Http\Request;
use Lucid\Units\Feature;
use Lucid\Domains\Http\Jobs\RespondWithJsonJob;
use Lucid\Domains\Http\Jobs\RespondWithJsonErrorJob;
use Lucid\Exceptions\InvalidInputException;

use App\Domains\Client\Jobs\SaveClientJob;
use App\Domains\Client\Jobs\ValidateClientInputJob;

class UpdateClientFeature extends Feature
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
        $validator = $this->run(new ValidateClientInputJob($request->input(), $this->id));

        if ($validator->fails()) {
            return $this->run(RespondWithJsonErrorJob::class, [
                'message' => $validator->errors(),
                'status' => 422,
            ]);
        }

        $client = $this->run(SaveClientJob::class, [
            'id' => $this->id,
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ]);

        return $this->run(RespondWithJsonJob::class, [
            'content' => $client,
            'status' => 200
        ]);
    }
}
