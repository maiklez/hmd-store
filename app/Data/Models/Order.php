<?php

namespace App\Data\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    /**
     * The orders that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'client_id',
        'store_id',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_orders', 'order_id', 'prod_id')->withPivot('quantity');
    }

    public function totalPrice()
    {
        return $this->products()->get()->reduce(function ($acc, $product) {
            return $acc + $product->price * $product->pivot->quantity;
        });
    }
}
