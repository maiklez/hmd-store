<?php

namespace App\Domains\Attribute\Jobs;

use Lucid\Units\Job;
use App\Data\Repositories\AttributeRepository;

class ReadAttributeJob extends Job
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
    public function handle(AttributeRepository $attributeRepo)
    {
        if($this->id)
        {
            return $attributeRepo->findById($this->id);
        }

        return $attributeRepo->getAll();
    }
}
