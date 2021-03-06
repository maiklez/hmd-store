<?php

namespace App\Domains\Provider\Jobs;

use Lucid\Units\Job;
use App\Data\Repositories\ProviderRepository;

class ReadProductProvidersJob extends Job
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
    public function handle(ProviderRepository $providerRepo)
    {
        return $providerRepo->findProducts($this->id);
    }
}
