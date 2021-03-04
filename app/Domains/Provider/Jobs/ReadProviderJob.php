<?php

namespace App\Domains\Provider\Jobs;

use Lucid\Units\Job;
use App\Data\Repositories\ProviderRepository;

class ReadProviderJob extends Job
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
    public function handle(ProviderRepository $providerRepo)
    {
        if($this->id)
        {
            return $providerRepo->findById($this->id);
        }

        return $providerRepo->getAll();
    }
}
