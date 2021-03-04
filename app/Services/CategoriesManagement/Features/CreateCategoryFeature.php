<?php

namespace App\Services\CategoriesManagement\Features;

use Illuminate\Http\Request;
use Lucid\Units\Feature;
use Lucid\Domains\Http\Jobs\RespondWithJsonJob;
use Lucid\Domains\Http\Jobs\RespondWithJsonErrorJob;
use Lucid\Exceptions\InvalidInputException;

use App\Domains\Category\Jobs\SaveCategoryJob;
use App\Domains\Category\Jobs\ValidateCategoryInputJob;

class CreateCategoryFeature extends Feature
{
    public function handle(Request $request)
    {
        $validator = $this->run(new ValidateCategoryInputJob($request->input()));

        if ($validator->fails()) {
            return $this->run(RespondWithJsonErrorJob::class, [
                'message' => $validator->errors(),
                'status' => 422,
            ]);
        }

        $category = $this->run(SaveCategoryJob::class, [
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
            'description' => $request->input('description'),
        ]);

        return $this->run(RespondWithJsonJob::class, [
            'content' => $category,
            'status' => 201
        ]);
    }
}
