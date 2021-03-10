<?php

namespace App\Domains\Client\Jobs;

use Lucid\Units\Job;
use App\Data\Repositories\ClientRepository;

class ReadClientJob extends Job
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
    public function handle(ClientRepository $clientRepo)
    {
        if($this->id)
        {
            return $clientRepo->findById($this->id);
        }

        return $clientRepo->getAll();
    }
}
