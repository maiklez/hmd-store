<?php

namespace App\Services\ProductsManagement\Http\Controllers;

use Lucid\Units\Controller;
use App\Services\ProductsManagement\Features\ListProductsFeature;
use App\Services\ProductsManagement\Features\ListProductBestSellersFeature;
use App\Services\ProductsManagement\Features\CreateProductFeature;
use App\Services\ProductsManagement\Features\ReadProductFeature;
use App\Services\ProductsManagement\Features\UpdateProductFeature;
use App\Services\ProductsManagement\Features\DeleteProductFeature;
use App\Services\ProductsManagement\Features\ListProductAttributesFeature;

class ProductController extends Controller
{

    public function getProducts()
    {
        return $this->serve(ListProductsFeature::class);
    }


    public function listProductAttributes($type, $value)
    {
        return $this->serve(ListProductAttributesFeature::class, [
            'type' => $type,
            'value' => $value,
        ]);
    }

    public function getProductsBestSellers()
    {
        return $this->serve(ListProductBestSellersFeature::class);
    }

    public function createProduct()
    {
        return $this->serve(CreateProductFeature::class);
    }

    public function readProduct($id)
    {
        return $this->serve(ReadProductFeature::class, [ 'id' => $id]);
    }

    public function updateProduct($id)
    {
        return $this->serve(UpdateProductFeature::class, [ 'id' => $id]);
    }

    public function deleteProduct($id)
    {
        return $this->serve(DeleteProductFeature::class, [ 'id' => $id]);
    }
}
