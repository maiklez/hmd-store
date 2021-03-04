<?php

namespace App\Domains\ProductAttribute\Jobs;

use Lucid\Units\Job;
use App\Data\Repositories\ProductAttributeRepository;

class SaveProductAttributeJob extends Job
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id = null, int $prod_id = null, string $type = null, string $value)
    {
        $this->id = $id;
        $this->prod_id = $prod_id;
        $this->type = $type;
        $this->value = $value;
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
            return $productattributeRepo->updateById($this->id, $this->value);
        }

        return $productattributeRepo->create($this->prod_id, $this->type, $this->value);
    }
}
