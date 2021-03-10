<?php

namespace App\Domains\Order\Jobs;

use Lucid\Units\Job;
use App\Data\Repositories\OrderRepository;

class ReadOrderJob extends Job
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
    public function handle(OrderRepository $orderRepo)
    {
        if($this->id)
        {
            return $orderRepo->findById($this->id);
        }

        return $orderRepo->getAll();
    }
}
