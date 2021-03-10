<?php

namespace App\Services\OrdersManagement\Http\Controllers;

use Lucid\Units\Controller;
use App\Services\OrdersManagement\Features\ListOrdersFeature;
use App\Services\OrdersManagement\Features\CreateOrderFeature;
use App\Services\OrdersManagement\Features\ReadOrderFeature;
use App\Services\OrdersManagement\Features\UpdateOrderFeature;
use App\Services\OrdersManagement\Features\DeleteOrderFeature;
use App\Services\OrdersManagement\Features\AddProductFeature;

class OrderController extends Controller
{

    public function getOrders()
    {
        return $this->serve(ListOrdersFeature::class);
    }

    public function createOrder()
    {
        return $this->serve(CreateOrderFeature::class);
    }

    public function readOrder($id)
    {
        return $this->serve(ReadOrderFeature::class, [ 'id' => $id]);
    }

    public function updateOrder($id)
    {
        return $this->serve(UpdateOrderFeature::class, [ 'id' => $id]);
    }

    public function addProducts($id)
    {
        return $this->serve(AddProductFeature::class, [ 'id' => $id]);
    }

    public function deleteOrder($id)
    {
        return $this->serve(DeleteOrderFeature::class, [ 'id' => $id]);
    }
}
