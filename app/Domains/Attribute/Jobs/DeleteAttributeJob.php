<?php

namespace App\Domains\Attribute\Jobs;

use Lucid\Units\Job;
use App\Data\Repositories\AttributeRepository;

class DeleteAttributeJob extends Job
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
    public function handle(AttributeRepository $attributeRepo)
    {
        return $attributeRepo->deleteById($this->id);
    }
}
