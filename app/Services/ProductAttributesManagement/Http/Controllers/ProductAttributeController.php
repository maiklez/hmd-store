<?php

namespace App\Services\ProductAttributesManagement\Http\Controllers;

use Lucid\Units\Controller;
use App\Services\ProductAttributesManagement\Features\ListProductAttributesFeature;
use App\Services\ProductAttributesManagement\Features\CreateProductAttributeFeature;
use App\Services\ProductAttributesManagement\Features\ReadProductAttributeFeature;
use App\Services\ProductAttributesManagement\Features\UpdateProductAttributeFeature;
use App\Services\ProductAttributesManagement\Features\DeleteProductAttributeFeature;

class ProductAttributeController extends Controller
{

    public function getProductAttributes()
    {
        return $this->serve(ListProductAttributesFeature::class);
    }

    public function createProductAttribute()
    {
        return $this->serve(CreateProductAttributeFeature::class);
    }

    public function readProductAttribute($id)
    {
        return $this->serve(ReadProductAttributeFeature::class, [ 'id' => $id]);
    }

    public function updateProductAttribute($id)
    {
        return $this->serve(UpdateProductAttributeFeature::class, [ 'id' => $id]);
    }

    public function deleteProductAttribute($id)
    {
        return $this->serve(DeleteProductAttributeFeature::class, [ 'id' => $id]);
    }
}
