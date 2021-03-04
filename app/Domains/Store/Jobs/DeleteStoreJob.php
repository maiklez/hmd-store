<?php

namespace App\Domains\Store\Jobs;

use Lucid\Units\Job;
use App\Data\Repositories\StoreRepository;

class DeleteStoreJob extends Job
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
    public function handle(StoreRepository $storeRepo)
    {
        return $storeRepo->deleteById($this->id);
    }
}
