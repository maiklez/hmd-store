<?php

namespace App\Domains\Client\Jobs;

use Lucid\Units\Job;
use App\Data\Repositories\ClientRepository;

class SaveClientJob extends Job
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id = null, string $name, string $email)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(ClientRepository $clientRepo)
    {
        if($this->id)
        {
            return $clientRepo->updateById($this->id, $this->name, $this->email);
        }

        return $clientRepo->create($this->name, $this->email);
    }
}
