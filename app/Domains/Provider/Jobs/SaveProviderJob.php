<?php

namespace App\Domains\Provider\Jobs;

use Lucid\Units\Job;
use App\Data\Repositories\ProviderRepository;

class SaveProviderJob extends Job
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id = null, string $name, string $cif)
    {
        $this->id = $id;
        $this->name = $name;
        $this->cif = $cif;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(ProviderRepository $providerRepo)
    {
        if($this->id)
        {
            return $providerRepo->updateById($this->id, $this->name, $this->cif);
        }

        return $providerRepo->create($this->name, $this->cif);
    }
}
