<?php

namespace App\Services\ClientsManagement\Features;

use Illuminate\Http\Request;
use Lucid\Units\Feature;
use Lucid\Domains\Http\Jobs\RespondWithJsonJob;
use Lucid\Domains\Http\Jobs\RespondWithJsonErrorJob;
use Lucid\Exceptions\InvalidInputException;

use App\Domains\Client\Jobs\ReadClientJob;
use App\Domains\Client\Jobs\ValidateClientInputJob;

class ReadClientFeature extends Feature
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
        $client = $this->run(ReadClientJob::class, [
            'id' => $this->id,
        ]);

        return $this->run(RespondWithJsonJob::class, [
            'content' => $client,
            'status' => 200
        ]);
    }
}
