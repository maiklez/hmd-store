<?php

namespace App\Domains\Store\Jobs;

use Lucid\Units\Job;
use App\Data\Repositories\StoreRepository;

class ReadStoreJob extends Job
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
    public function handle(StoreRepository $storeRepo)
    {
        if($this->id)
        {
            return $storeRepo->findById($this->id);
        }

        return $storeRepo->getAll();
    }
}
