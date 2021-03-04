<?php

namespace App\Domains\Category\Jobs;

use Lucid\Units\Job;
use App\Data\Repositories\CategoryRepository;

class ReadCategoryJob extends Job
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
    public function handle(CategoryRepository $categoryRepo)
    {
        if($this->id)
        {
            return $categoryRepo->findById($this->id);
        }

        return $categoryRepo->getAll();
    }
}
