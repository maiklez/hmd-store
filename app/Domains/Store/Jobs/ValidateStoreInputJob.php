<?php

namespace App\Domains\Store\Jobs;

use Lucid\Units\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ValidateStoreInputJob extends Job
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
            'address' => ['required', 'string', 'max:1000'],
            'url' => ['required', 'url', 'unique:stores'],
        ];
    }

    private function rulesToUpdate(){
        return [
            'name' => ['required', 'string', 'max:100'],
            'address' => ['required', 'string', 'max:1000'],
            'url' => ['required', 'url', 'unique:stores,slug,'.$this->id],
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
