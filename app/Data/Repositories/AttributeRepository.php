<?php

namespace App\Data\Repositories;

use App\Exceptions\NotFoundException;
use App\Data\Models\Attribute;
use App\Data\Repositories\Repository;

class AttributeRepository
{
    public function create(string $name, string $slug, string $description)
    {
        $attribute = new Attribute();

        $attribute->fill([
            'name' => $name,
            'slug' => $slug,
            'description' => $description,
        ]);

        $attribute->save();

        return $attribute;
    }

    public function findById($id)
    {
        $attribute = Attribute::find($id);
        if (!$attribute)
        {
          throw new NotFoundException('attribute not found');
        }
        return $attribute;
    }

    public function findBySlug($slug)
    {
        $attribute = Attribute::where('slug', 'like', $slug)->first();
        if (!$attribute)
        {
          throw new NotFoundException('attribute not found '. $slug);
        }
        return $attribute;
    }

    public function getAll()
    {
        $attributes = Attribute::all();

        return $attributes;
    }

    public function updateById($id, string $name, string $slug, string $description)
    {
        $attribute = $this->findById($id);

        $attribute->fill([
            'name' => $name,
            'slug' => $slug,
            'description' => $description,
        ]);

        $attribute->save();

        return $attribute;
    }

    public function deleteById($id)
    {
        $attribute = $this->findById($id);

        return $attribute->delete();
    }
}
