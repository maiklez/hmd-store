<?php

namespace App\Data\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Provider extends Model
{
    use HasFactory;

    protected $table = 'providers';

    /**
     * The providers that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'cif',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_providers', 'prov_id', 'prod_id');
    }
}
