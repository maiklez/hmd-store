<?php

namespace App\Services\AttributesManagement\Features;

use Illuminate\Http\Request;
use Lucid\Units\Feature;
use Lucid\Domains\Http\Jobs\RespondWithJsonJob;
use Lucid\Domains\Http\Jobs\RespondWithJsonErrorJob;
use Lucid\Exceptions\InvalidInputException;

use App\Domains\Attribute\Jobs\SaveAttributeJob;
use App\Domains\Attribute\Jobs\ValidateAttributeInputJob;

class UpdateAttributeFeature extends Feature
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
        $validator = $this->run(new ValidateAttributeInputJob($request->input(), $this->id));

        if ($validator->fails()) {
            return $this->run(RespondWithJsonErrorJob::class, [
                'message' => $validator->errors(),
                'status' => 422,
            ]);
        }

        $attribute = $this->run(SaveAttributeJob::class, [
            'id' => $this->id,
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
            'description' => $request->input('description'),
        ]);

        return $this->run(RespondWithJsonJob::class, [
            'content' => $attribute,
            'status' => 200
        ]);
    }
}
