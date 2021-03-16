<?php

namespace App\Data\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use App\Exceptions\NotFoundException;
use App\Data\Models\Store;
use App\Data\Repositories\Repository;

class StoreRepository
{
    public function create(string $name, string $address, string $url)
    {
        $store = new Store();

        $store->fill([
            'name' => $name,
            'address' => $address,
            'url' => $url,
        ]);

        $store->save();

        return $store;
    }

    public function findById($id)
    {
        $store = Store::find($id);
        if (!$store)
        {
          throw new NotFoundException('store not found');
        }
        return $store;
    }

    public function findBySlug($url)
    {
        $store = Store::where('url', $url)->first();
        if (!$store)
        {
          throw new NotFoundException('store not found');
        }
        return $store;
    }

    public function getAll()
    {
        $stores = Store::all();

        return $stores;
    }

    public function topBilling($storeId)
    {
        $stores = Store::whereHas('orders.products')->get()->load('orders.products')
        ->each(function ($store) {
            $store->totalBilling = $store->orders->reduce (function ($acc, $order) {
                return $acc + $order->products->reduce (function ($acc, $product) {
                    return $acc + ( $product->price * $product->pivot->quantity );
                }, 0);
            }, 0);
        })->sortByDesc('totalBilling');

        return $stores;
    }

    public function topSellers()
    {
        $stores = Store::whereHas('orders.products')->get()->load('orders.products')
        ->each(function ($store) {
            $store->totalProducts = $store->orders->reduce (function ($acc, $order) {
                return $acc + $order->products->reduce (function ($acc, $product) {
                    return $acc + $product->pivot->quantity;
                }, 0);
            }, 0);
        })->sortByDesc('totalProducts');;

        return $stores;
    }

    public function updateById($id, string $name, string $address, string $url)
    {
        $store = $this->findById($id);

        $store->fill([
            'name' => $name,
            'address' => $address,
            'url' => $url,
        ]);

        $store->save();

        return $store;
    }

    public function deleteById($id)
    {
        $store = $this->findById($id);

        return $store->delete();
    }
}
