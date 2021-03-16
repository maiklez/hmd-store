<?php

namespace App\Domains\Contact\Jobs;

use Lucid\Units\Job;
use App\Data\Repositories\ContactRepository;

class SaveContactJob extends Job
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id = null, $related_id = null, string $type = null, string $name, string $email, string $phone)
    {
        $this->id = $id;
        $this->related_id = $related_id;
        $this->type = $type;
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(ContactRepository $contactRepo)
    {
        if($this->id)
        {
            return $contactRepo->updateById($this->id, $this->name, $this->email, $this->phone);
        }

        return $contactRepo->create($this->name, $this->email, $this->phone, $this->related_id, $this->type);
    }
}
