<?php

namespace App\Services\CategoriesManagement\Http\Controllers;

use Lucid\Units\Controller;
use App\Services\CategoriesManagement\Features\ListCategoriesFeature;
use App\Services\CategoriesManagement\Features\CreateCategoryFeature;
use App\Services\CategoriesManagement\Features\ReadCategoryFeature;
use App\Services\CategoriesManagement\Features\UpdateCategoryFeature;
use App\Services\CategoriesManagement\Features\DeleteCategoryFeature;

class CategoryController extends Controller
{

    public function getCategories()
    {
        return $this->serve(ListCategoriesFeature::class);
    }

    public function createCategory()
    {
        return $this->serve(CreateCategoryFeature::class);
    }

    public function readCategory($id)
    {
        return $this->serve(ReadCategoryFeature::class, [ 'id' => $id]);
    }

    public function updateCategory($id)
    {
        return $this->serve(UpdateCategoryFeature::class, [ 'id' => $id]);
    }

    public function deleteCategory($id)
    {
        return $this->serve(DeleteCategoryFeature::class, [ 'id' => $id]);
    }
}
