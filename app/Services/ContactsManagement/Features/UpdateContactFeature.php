<?php

namespace App\Services\ContactsManagement\Features;

use Illuminate\Http\Request;
use Lucid\Units\Feature;
use Lucid\Domains\Http\Jobs\RespondWithJsonJob;
use Lucid\Domains\Http\Jobs\RespondWithJsonErrorJob;
use Lucid\Exceptions\InvalidInputException;

use App\Domains\Contact\Jobs\SaveContactJob;
use App\Domains\Contact\Jobs\ValidateContactInputJob;

class UpdateContactFeature extends Feature
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
        $validator = $this->run(new ValidateContactInputJob($request->input(), $this->id));

        if ($validator->fails()) {
            return $this->run(RespondWithJsonErrorJob::class, [
                'message' => $validator->errors(),
                'status' => 422,
            ]);
        }

        $contact = $this->run(SaveContactJob::class, [
            'id' => $this->id,
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
        ]);

        return $this->run(RespondWithJsonJob::class, [
            'content' => $contact,
            'status' => 200
        ]);
    }
}
