<?php

namespace App\Domains\Contact\Jobs;

use Lucid\Units\Job;
use App\Data\Repositories\ContactRepository;

class ReadContactJob extends Job
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id = null)
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
        if($this->id)
        {
            return $contactRepo->findById($this->id);
        }

        return $contactRepo->getAll();
    }
}
