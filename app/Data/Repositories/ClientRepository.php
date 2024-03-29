<?php

namespace App\Data\Repositories;

use App\Exceptions\NotFoundException;
use App\Data\Models\Client;
use App\Data\Repositories\Repository;

class ClientRepository
{
    public function create(string $name, string $email)
    {
        $client = new Client();

        $client->fill([
            'name' => $name,
            'email' => $email,
        ]);

        $client->save();

        return $client;
    }

    public function findById($id)
    {
        $client = Client::find($id);
        if (!$client)
        {
          throw new NotFoundException('client not found');
        }
        return $client;
    }

    public function findByEmail($email)
    {
        $client = Client::where('email', $email)->first();
        if (!$client)
        {
          throw new NotFoundException('client not found');
        }
        return $client;
    }

    public function getAll()
    {
        $clients = Client::all();

        return $clients;
    }

    public function topBuyer()
    {
        $clients = Client::whereHas('orders.products')->get()->load('orders.products')
        ->each(function ($client) {
            $client->totalBuy = $client->orders->reduce (function ($acc, $order) {
                return $acc + $order->products->reduce (function ($acc, $product) {
                    return $acc + ( $product->price * $product->pivot->quantity );
                }, 0);
            }, 0);
        })->sortByDesc('totalBuy');;

        return $clients;
    }

    public function updateById($id, string $name, string $email)
    {
        $client = $this->findById($id);

        $client->fill([
            'name' => $name,
            'email' => $email,
        ]);

        $client->save();

        return $client;
    }

    public function deleteById($id)
    {
        $client = $this->findById($id);

        return $client->delete();
    }
}
