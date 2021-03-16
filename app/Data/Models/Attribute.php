<?php

namespace App\Data\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attribute extends Model
{
    use HasFactory;

    protected $table = 'attributes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    public function  slug()
    {
        return $this->slug;
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_attributes', 'type', 'prod_id', 'slug', 'id')->using(ProductAttribute::class);
    }

    public function productAttributes()
    {
        return $this->hasMany(ProductAttribute::class, 'type');
    }
}
