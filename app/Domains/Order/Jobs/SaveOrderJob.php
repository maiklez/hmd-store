<?php

namespace App\Domains\Order\Jobs;

use Lucid\Units\Job;
use App\Data\Repositories\OrderRepository;

class SaveOrderJob extends Job
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id = null, $client_id = null, $store_id = null, $prod_id = null, $quantity = null)
    {
        $this->id = $id;
        $this->client_id = $client_id;
        $this->store_id = $store_id;
        $this->prod_id = $prod_id;
        $this->quantity = $quantity;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(OrderRepository $orderRepo)
    {
        if($this->id && $this->prod_id)
        {
            return $orderRepo->addProduct($this->id, $this->prod_id, $this->quantity);
        }
        elseif ($this->id)
        {
            return $orderRepo->updateById($this->id, $this->client_id, $this->store_id);
        }

        return $orderRepo->create($this->client_id, $this->store_id, $this->prod_id, $this->quantity);
    }
}
