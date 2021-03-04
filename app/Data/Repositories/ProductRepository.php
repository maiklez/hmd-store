<?php

namespace App\Data\Repositories;

use App\Exceptions\NotFoundException;
use App\Data\Models\Product;
use App\Data\Repositories\Repository;

class ProductRepository
{
    public function create(string $name, string $slug, string $description, string $price)
    {
        $product = new Product();

        $product->fill([
            'name' => $name,
            'slug' => $slug,
            'price' => $price,
            'description' => $description,
        ]);

        $product->save();

        return $product;
    }

    public function findById($id)
    {
        $product = Product::find($id);
        if (!$product)
        {
          throw new NotFoundException('product not found');
        }
        return $product;
    }

    public function getAll()
    {
        $products = Product::all();

        return $products;
    }

    public function updateById($id, string $name, string $slug, string $description, string $price)
    {
        $product = $this->findById($id);

        $product->fill([
            'name' => $name,
            'slug' => $slug,
            'price' => $price,
            'description' => $description,
        ]);

        $product->save();

        return $product;
    }

    public function deleteById($id)
    {
        $product = $this->findById($id);

        return $product->delete();
    }
}
