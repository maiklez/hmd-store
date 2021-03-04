<?php

namespace App\Domains\Category\Jobs;

use Lucid\Units\Job;
use App\Data\Repositories\CategoryRepository;

class DeleteCategoryJob extends Job
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
    public function handle(CategoryRepository $categoryRepo)
    {
        return $categoryRepo->deleteById($this->id);
    }
}
