<?php

namespace App\Domains\Contact\Jobs;

use Lucid\Units\Job;
use App\Data\Repositories\ContactRepository;

class DeleteContactJob extends Job
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(ContactRepository $contactRepo)
    {
        return $contactRepo->deleteById($this->id);
    }
}
