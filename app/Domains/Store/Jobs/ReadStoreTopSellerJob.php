<?php

namespace App\Domains\Store\Jobs;

use Lucid\Units\Job;
use App\Data\Repositories\StoreRepository;

class ReadStoreTopSellerJob extends Job
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(StoreRepository $storeRepo)
    {
        return $storeRepo->topSellers();
    }
}
