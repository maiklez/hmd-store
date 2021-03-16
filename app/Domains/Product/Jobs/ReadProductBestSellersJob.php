<?php

namespace App\Domains\Product\Jobs;

use Lucid\Units\Job;
use App\Data\Repositories\ProductRepository;

class ReadProductBestSellersJob extends Job
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
    public function handle(ProductRepository $productRepo)
    {
        return $productRepo->getBestSellers($this->store_id);
    }
}
