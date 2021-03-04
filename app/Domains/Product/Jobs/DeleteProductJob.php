<?php

namespace App\Domains\Product\Jobs;

use Lucid\Units\Job;
use App\Data\Repositories\ProductRepository;

class DeleteProductJob extends Job
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
    public function handle(ProductRepository $productRepo)
    {
        return $productRepo->deleteById($this->id);
    }
}
