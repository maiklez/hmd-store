<?php

namespace App\Data\Repositories;

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
