<?php

namespace App\Domains\Client\Jobs;

use Lucid\Units\Job;
use App\Data\Repositories\ClientRepository;

class DeleteClientJob extends Job
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
    public function handle(ClientRepository $clientRepo)
    {
        return $clientRepo->deleteById($this->id);
    }
}
