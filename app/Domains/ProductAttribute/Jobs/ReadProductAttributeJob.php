<?php

namespace App\Domains\ProductAttribute\Jobs;

use Lucid\Units\Job;
use App\Data\Repositories\ProductAttributeRepository;

class ReadProductAttributeJob extends Job
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
    public function handle(ProductAttributeRepository $productattributeRepo)
    {
        if($this->id)
        {
            return $productattributeRepo->findById($this->id);
        }

        return $productattributeRepo->getAll();
    }
}
