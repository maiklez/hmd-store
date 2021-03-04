<?php

namespace App\Domains\Product\Jobs;

use Lucid\Units\Job;
use App\Data\Repositories\ProductRepository;

class SaveProductJob extends Job
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id = null, string $name, string $slug, string $description, string $price)
    {
        $this->id = $id;
        $this->name = $name;
        $this->slug = $slug;
        $this->price = $price;
        $this->description = $description;
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
            return $productRepo->updateById($this->id, $this->name, $this->slug, $this->price, $this->description);
        }

        return $productRepo->create($this->name, $this->slug, $this->price, $this->description);
    }
}
