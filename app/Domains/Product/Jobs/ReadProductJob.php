<?php

namespace App\Domains\Product\Jobs;

use Lucid\Units\Job;
use App\Data\Repositories\ProductRepository;

class ReadProductJob extends Job
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
    public function handle(ProductRepository $productRepo)
    {
        if($this->id)
        {
            return $productRepo->findById($this->id);
        }

        return $productRepo->getAll();
    }
}
