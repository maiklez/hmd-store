<?php

namespace App\Services\AttributesManagement\Features;

use Illuminate\Http\Request;
use Lucid\Units\Feature;
use Lucid\Domains\Http\Jobs\RespondWithJsonJob;
use Lucid\Domains\Http\Jobs\RespondWithJsonErrorJob;
use Lucid\Exceptions\InvalidInputException;

use App\Domains\Attribute\Jobs\DeleteAttributeJob;
use App\Domains\Attribute\Jobs\ValidateAttributeInputJob;

class DeleteAttributeFeature extends Feature
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
        $attribute = $this->run(DeleteAttributeJob::class, [
            'id' => $this->id,
        ]);

        return $this->run(RespondWithJsonJob::class, [
            'content' => $attribute,
            'status' => 204
        ]);
    }
}
