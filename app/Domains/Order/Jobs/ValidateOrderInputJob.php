<?php

namespace App\Domains\Order\Jobs;

use Lucid\Units\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ValidateOrderInputJob extends Job
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
            'client_id' => ['required', 'integer'],
            'store_id' => ['required', 'integer'],
            'prod_id' => ['required', 'integer'],
            'quantity' => ['required', 'integer'],
        ];
    }

    private function rulesToUpdate(){
        return [
            'client_id' => ['required', 'integer'],
            'store_id' => ['required', 'integer'],
        ];
    }

    private function rulesToAddProduct(){
        return [
            'prod_id' => ['required', 'integer'],
            'quantity' => ['required', 'integer'],
        ];
    }

    /**
     * Execute the job.
     *
     */
    public function handle()
    {
        if($this->id && isset($this->input['prod_id']))
        {
            return Validator::make($this->input, $this->rulesToAddProduct());
        }
        elseif ($this->id)
        {
            return Validator::make($this->input, $this->rulesToUpdate());
        }

        return Validator::make($this->input, $this->rulesToCreate());;
    }
}
