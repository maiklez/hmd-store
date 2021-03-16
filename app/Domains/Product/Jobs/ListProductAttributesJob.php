<?php

namespace App\Domains\Product\Jobs;

use Lucid\Units\Job;
use App\Data\Repositories\ProductRepository;

class ListProductAttributesJob extends Job
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($type, $value)
    {
        $this->type = $type;
        $this->value = $value;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(ProductRepository $prodRepo)
    {
        $prodAttr = $prodRepo->findByAttribute($this->type, $this->value);
        return $prodAttr;
    }
}
