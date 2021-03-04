<?php

namespace App\Domains\ProductAttribute\Jobs;

use Lucid\Units\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ValidateProductAttributeInputJob extends Job
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
            'prod_id' => ['required', 'integer'],
            'type' => ['required', 'string', 'max:100'],
            'value' => ['required', 'string', 'max:100'],
        ];
    }

    private function rulesToUpdate(){
        return [
            'value' => ['required', 'string', 'max:100'],
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
