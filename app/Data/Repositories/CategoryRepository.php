<?php

namespace App\Data\Repositories;

use App\Exceptions\NotFoundException;
use App\Data\Models\Category;
use App\Data\Repositories\Repository;

class CategoryRepository
{
    public function create(string $name, string $slug, string $description)
    {
        $category = new Category();

        $category->fill([
            'name' => $name,
            'slug' => $slug,
            'description' => $description,
        ]);

        $category->save();

        return $category;
    }

    public function findById($id)
    {
        $category = Category::find($id);
        if (!$category)
        {
          throw new NotFoundException('category not found');
        }
        return $category;
    }

    public function findBySlug($slug)
    {
        $category = Category::where('slug', $slug)->first();
        if (!$category)
        {
          throw new NotFoundException('category not found');
        }
        return $category;
    }

    public function getAll()
    {
        $categories = Category::all();

        return $categories;
    }

    public function updateById($id, string $name, string $slug, string $description)
    {
        $category = $this->findById($id);

        $category->fill([
            'name' => $name,
            'slug' => $slug,
            'description' => $description,
        ]);

        $category->save();

        return $category;
    }

    public function deleteById($id)
    {
        $category = $this->findById($id);

        return $category->delete();
    }
}
