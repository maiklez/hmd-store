<?php

namespace App\Domains\Provider\Jobs;

use Lucid\Units\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ValidateProviderInputJob extends Job
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
            'cif' => ['required', 'string','min:9', 'max:9', 'unique:providers'],
        ];
    }

    private function rulesToUpdate(){
        return [
            'name' => ['required', 'string', 'max:100'],
            'cif' => ['required', 'string', 'min:9', 'max:9', 'unique:providers,slug,'.$this->id],
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
