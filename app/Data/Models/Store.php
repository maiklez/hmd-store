<?php

namespace App\Data\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Store extends Model
{
    use HasFactory;

    protected $table = 'stores';

    /**
     * The stores that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'address',
        'url',
    ];

    public function orders(){
        return $this->hasMany(Order::class, 'store_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_stores', 'store_id', 'prod_id');
    }

    public function contacts()
    {
        return $this->morphMany(Contact::class, 'contact');
    }

    public function productsOrders()
    {
        return $this->orders()->products();
    }

    public function totalPrices()
    {
        return $this->orders()->get()->reduce(function ($acc, $order) {
            return $acc + $order->totalPrice();
        });
    }
}
