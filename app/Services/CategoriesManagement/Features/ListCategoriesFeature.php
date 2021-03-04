<?php

namespace App\Services\CategoriesManagement\Features;

use Illuminate\Http\Request;
use Lucid\Units\Feature;
use Lucid\Domains\Http\Jobs\RespondWithJsonJob;

use App\Domains\Category\Jobs\ReadCategoryJob;

class ListCategoriesFeature extends Feature
{
    public function handle(Request $request)
    {
        $categories = $this->run(ReadCategoryJob::class);

        return $this->run(new RespondWithJsonJob($categories));
    }
}
