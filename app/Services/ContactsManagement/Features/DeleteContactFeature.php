<?php

namespace App\Services\ContactsManagement\Features;

use Illuminate\Http\Request;
use Lucid\Units\Feature;
use Lucid\Domains\Http\Jobs\RespondWithJsonJob;
use Lucid\Domains\Http\Jobs\RespondWithJsonErrorJob;
use Lucid\Exceptions\InvalidInputException;

use App\Domains\Contact\Jobs\DeleteContactJob;
use App\Domains\Contact\Jobs\ValidateContactInputJob;

class DeleteContactFeature extends Feature
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
        $contact = $this->run(DeleteContactJob::class, [
            'id' => $this->id,
        ]);

        return $this->run(RespondWithJsonJob::class, [
            'content' => $contact,
            'status' => 204
        ]);
    }
}
