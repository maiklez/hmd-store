<?php

namespace App\Data\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
    ];

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'product_attributes', 'prod_id', 'type');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_categories', 'prod_id', 'category_id');
    }

    public function providers()
    {
        return $this->belongsToMany(Provider::class, 'product_providers', 'prod_id', 'prov_id');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'product_orders', 'prod_id', 'order_id');
    }

    public function stores()
    {
        return $this->belongsToMany(Store::class, 'product_stores', 'prod_id', 'store_id');
    }
}
