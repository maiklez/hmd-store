<?php

namespace App\Data\Repositories;

use App\Exceptions\NotFoundException;
use App\Data\Models\ProductAttribute;
use App\Data\Repositories\Repository;

class ProductAttributeRepository
{
    public function create(int $prod_id, string $type, string $value)
    {
        $prodRepo = new ProductRepository();
        $product = $prodRepo->findById($prod_id);

        $attrRepo = new AttributeRepository();
        $attr = $attrRepo->findBySlug($type);

        $productattribute = new ProductAttribute();

        $productattribute->fill([
            'prod_id' => $product->id,
            'type' => $type,
            'value' => $value,
        ]);

        $productattribute->save();

        return $productattribute;
    }

    public function findById($id)
    {
        $productattribute = ProductAttribute::find($id);
        if (!$productattribute)
        {
          throw new NotFoundException('productattribute not found');
        }
        return $productattribute;
    }

    public function getAll()
    {
        $productattributes = ProductAttribute::all();

        return $productattributes;
    }

    public function updateById($id, string $value)
    {
        $productattribute = $this->findById($id);

        $productattribute->value = $value;

        $productattribute->save();

        return $productattribute;
    }

    public function deleteById($id)
    {
        $productattribute = $this->findById($id);

        return $productattribute->delete();
    }
}
