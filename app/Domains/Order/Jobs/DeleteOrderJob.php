<?php

namespace App\Domains\Order\Jobs;

use Lucid\Units\Job;
use App\Data\Repositories\OrderRepository;

class DeleteOrderJob extends Job
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
    public function handle(OrderRepository $orderRepo)
    {
        return $orderRepo->deleteById($this->id);
    }
}
