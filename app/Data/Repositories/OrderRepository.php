<?php

namespace App\Data\Repositories;

use App\Exceptions\NotFoundException;
use App\Data\Models\Order;

class OrderRepository
{
    public function create($client_id, $store_id, $prod_id, $quantity)
    {
        $prodRepo = new ProductRepository();
        $product = $prodRepo->findById($prod_id);

        $clientRepo = new ClientRepository();
        $client = $prodRepo->findById($client_id);

        $storeRepo = new StoreRepository();
        $store = $prodRepo->findById($store_id);

        // prod in the same store

        $order = new Order();

        $order->fill([
            'client_id' => $client_id,
            'store_id' => $store_id,
        ]);

        $order->save();
        $order->products()->attach($prod_id, ['quantity' => $quantity]);

        return $order;
    }

    public function findById($id)
    {
        $order = Order::find($id);
        if (!$order)
        {
          throw new NotFoundException('order not found');
        }
        return $order;
    }

    public function getAll()
    {
        $orders = Order::all();

        return $orders;
    }

    public function updateById($id, $client_id, $store_id)
    {
        $order = $this->findById($id);

        $clientRepo = new ClientRepository();
        $client = $clientRepo->findById($client_id);

        $storeRepo = new StoreRepository();
        $store = $storeRepo->findById($store_id);

        $order->fill([
            'client_id' => $client_id,
            'store_id' => $store_id,
        ]);

        $order->save();

        return $order;
    }

    public function addProduct($id, $prod_id, $quantity)
    {
        $order = $this->findById($id);

        $prodRepo = new ProductRepository();
        $product = $prodRepo->findById($prod_id);
        // prod in the same store
        $product->stores();

        $order->products()->attach($prod_id, ['quantity' => $quantity]);

        $order->save();

        return $order;
    }

    public function removeProduct($id, $prod_id)
    {
        $order = $this->findById($id);

        $prodRepo = new ProductRepository();
        $product = $prodRepo->findById($prod_id);

        $order->products()->detach($prod_id);

        $order->save();

        return $order;
    }

    public function deleteById($id)
    {
        $order = $this->findById($id);

        return $order->delete();
    }
}
