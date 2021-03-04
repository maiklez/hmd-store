<?php

namespace App\Domains\Attribute\Jobs;

use Lucid\Units\Job;
use App\Data\Repositories\AttributeRepository;

class SaveAttributeJob extends Job
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id = null, string $name, string $slug, string $description)
    {
        $this->id = $id;
        $this->name = $name;
        $this->slug = $slug;
        $this->description = $description;
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
            return $attributeRepo->updateById($this->id, $this->name, $this->slug, $this->description);
        }

        return $attributeRepo->create($this->name, $this->slug, $this->description);
    }
}
