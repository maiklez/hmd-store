<?php

namespace App\Data\Repositories;

use Illuminate\Database\Eloquent\Builder;
use App\Exceptions\NotFoundException;
use App\Data\Models\Provider;
use App\Data\Repositories\Repository;

class ProviderRepository
{
    public function create(string $name, string $cif)
    {
        $provider = new Provider();

        $provider->fill([
            'name' => $name,
            'cif' => $cif,
        ]);

        $provider->save();

        return $provider;
    }

    public function findById($id)
    {
        $provider = Provider::find($id);
        if (!$provider)
        {
          throw new NotFoundException('provider not found');
        }
        return $provider;
    }

    public function findProducts($id)
    {
        $provider = Provider::find($id);
        if (!$provider)
        {
          throw new NotFoundException('provider not found');
        }
        return $provider->products()->get();
    }

    public function findBySlug($slug)
    {
        $provider = Provider::where('slug', $slug)->first();
        if (!$provider)
        {
          throw new NotFoundException('provider not found');
        }
        return $provider;
    }

    public function getAll()
    {
        $providers = Provider::all();

        return $providers;
    }

    public function getTopBilling()
    {
        $providers = Provider::whereHas('products.orders')->get()->load('products.orders')
        ->each(function ($provider) {
            $provider->totalBilling = $provider->products->reduce(function ($acc, $product) {
                return $acc + $product->orders->reduce(function ($acc, $order) use ($product){
                    return $acc + ( $product->price * $order->pivot->quantity );
                }, 0);
            }, 0);
        })->sortByDesc('totalBilling');

        return $providers;
    }

    public function updateById($id, string $name, string $cif)
    {
        $provider = $this->findById($id);

        $provider->fill([
            'name' => $name,
            'cif' => $cif,
        ]);

        $provider->save();

        return $provider;
    }

    public function deleteById($id)
    {
        $provider = $this->findById($id);

        return $provider->delete();
    }
}
