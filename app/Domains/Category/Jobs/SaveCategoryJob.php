<?php

namespace App\Domains\Category\Jobs;

use Lucid\Units\Job;
use App\Data\Repositories\CategoryRepository;

class SaveCategoryJob extends Job
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
    public function handle(CategoryRepository $categoryRepo)
    {
        if($this->id)
        {
            return $categoryRepo->updateById($this->id, $this->name, $this->slug, $this->description);
        }

        return $categoryRepo->create($this->name, $this->slug, $this->description);
    }
}
