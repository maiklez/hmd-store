<?php

namespace App\Domains\Contact\Jobs;

use Lucid\Units\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ValidateContactInputJob extends Job
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

    private function rules(){
        return [
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'max:50'],
            'phone' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:10', 'max:20'],
        ];
    }

    /**
     * Execute the job.
     *
     */
    public function handle()
    {
        return Validator::make($this->input, $this->rules());
    }
}
