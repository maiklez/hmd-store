<?php

namespace App\Data\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductAttribute extends Pivot
{
    use HasFactory;

    protected $table = 'product_attributes';

    public $incrementing = true;
    /**
     * The product_attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'prod_id',
        'type',
        'value',
    ];

    /**
     * Get the user that owns the phone.
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'prod_id');
    }

    /**
     * Get the user that owns the phone.
     */
    public function attribute()
    {
        return $this->belongsTo(Attribute::class, 'type', 'slug');
    }
}
