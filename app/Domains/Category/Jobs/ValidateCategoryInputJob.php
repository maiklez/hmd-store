<?php

namespace App\Domains\Category\Jobs;

use Lucid\Units\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ValidateCategoryInputJob extends Job
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
            'slug' => ['required', 'string', 'max:50', 'unique:categories'],
            'description' => ['required', 'string', 'max:1000'],
        ];
    }

    private function rulesToUpdate(){
        return [
            'name' => ['required', 'string', 'max:100'],
            'slug' => ['required', 'string', 'max:50', 'unique:categories,slug,'.$this->id],
            'description' => ['required', 'string', 'max:1000'],
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
