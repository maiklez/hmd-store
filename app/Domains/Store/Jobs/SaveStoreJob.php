<?php

namespace App\Domains\Store\Jobs;

use Lucid\Units\Job;
use App\Data\Repositories\StoreRepository;

class SaveStoreJob extends Job
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id = null, string $name, string $address, string $url)
    {
        $this->id = $id;
        $this->name = $name;
        $this->address = $address;
        $this->url = $url;
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
            return $storeRepo->updateById($this->id, $this->name, $this->address, $this->url);
        }

        return $storeRepo->create($this->name, $this->address, $this->url);
    }
}
