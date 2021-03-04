<?php

namespace App\Domains\Product\Jobs;

use Lucid\Units\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ValidateProductInputJob extends Job
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
            'slug' => ['required', 'string', 'max:50', 'unique:products'],
            'description' => ['required', 'string', 'max:1000'],
            'price' => ['required', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/', 'max:99999'],
        ];
    }

    private function rulesToUpdate(){
        return [
            'name' => ['required', 'string', 'max:100'],
            'slug' => ['required', 'string', 'max:50', 'unique:products,slug,'.$this->id],
            'description' => ['required', 'string', 'max:1000'],
            'price' => ['required', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/', 'max:99999'],
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
