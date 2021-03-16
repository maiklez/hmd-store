<?php

namespace App\Domains\Store\Jobs;

use Lucid\Units\Job;
use App\Data\Repositories\StoreRepository;

class ReadStoreTopBillingJob extends Job
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($store_id)
    {
        $this->store_id = $store_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(StoreRepository $storeRepo)
    {
        return $storeRepo->topBilling($this->store_id);
    }
}
