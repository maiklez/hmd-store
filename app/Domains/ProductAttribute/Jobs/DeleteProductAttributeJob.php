<?php

namespace App\Domains\ProductAttribute\Jobs;

use Lucid\Units\Job;
use App\Data\Repositories\ProductAttributeRepository;

class DeleteProductAttributeJob extends Job
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
    public function handle(ProductAttributeRepository $productattributeRepo)
    {
        return $productattributeRepo->deleteById($this->id);
    }
}
