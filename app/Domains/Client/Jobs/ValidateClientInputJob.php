<?php

namespace App\Domains\Client\Jobs;

use Lucid\Units\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ValidateClientInputJob extends Job
{
    /**
     * @var array
     */
    private $input;

    private $id;

    /**
     * Create a new job instance.
     * @param array $input
     */
    public function __construct(array $input, $id = null)
    {
        $this->input = $input;
        $this->id = $id;
    }

    private function rulesToCreate(){
        return [
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'max:50', 'unique:clients'],
        ];
    }

    private function rulesToUpdate(){
        return [
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'max:50', 'unique:clients,email,'.$this->id],
        ];
    }

    /**
     * Execute the job.
     *
     */
    public function handle()
    {
        if($this->id)
        {
            return Validator::make($this->input, $this->rulesToUpdate());
        }

        return Validator::make($this->input, $this->rulesToCreate());;
    }
}
