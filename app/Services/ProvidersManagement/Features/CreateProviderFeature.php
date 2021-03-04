<?php

namespace App\Services\ProvidersManagement\Features;

use Illuminate\Http\Request;
use Lucid\Units\Feature;
use Lucid\Domains\Http\Jobs\RespondWithJsonJob;
use Lucid\Domains\Http\Jobs\RespondWithJsonErrorJob;
use Lucid\Exceptions\InvalidInputException;

use App\Domains\Provider\Jobs\SaveProviderJob;
use App\Domains\Provider\Jobs\ValidateProviderInputJob;

class CreateProviderFeature extends Feature
{
    public function handle(Request $request)
    {
        $validator = $this->run(new ValidateProviderInputJob($request->input()));

        if ($validator->fails()) {
            return $this->run(RespondWithJsonErrorJob::class, [
                'message' => $validator->errors(),
                'status' => 422,
            ]);
        }

        $provider = $this->run(SaveProviderJob::class, [
            'name' => $request->input('name'),
            'cif' => $request->input('cif'),
        ]);

        return $this->run(RespondWithJsonJob::class, [
            'content' => $provider,
            'status' => 201
        ]);
    }
}
