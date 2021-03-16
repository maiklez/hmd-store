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

    public function productAttributes()
    {
        return $this->hasMany(ProductAttribute::class, 'prod_id');
    }
    public function attributes()
    {
        return $this->belongsToMany(Product::class, 'product_attributes', 'prod_id', 'type', 'id', 'slug')->using(ProductAttribute::class);
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
        return $this->belongsToMany(Order::class, 'product_orders', 'prod_id', 'order_id')->withPivot('quantity');
    }

    public function totalUnitsSelled($storeId)
    {
        if($storeId)
        {
            return $this->orders()->where('store_id', $storeId)->sum('product_orders.quantity');
        }
        return $this->orders()->sum('product_orders.quantity');
    }

    public function stores()
    {
        return $this->belongsToMany(Store::class, 'product_stores', 'prod_id', 'store_id');
    }
}
