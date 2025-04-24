<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'category_id',
        'description',
        'price',
        'discount_price',
        'metal_type',
        'weight_grams',
        'is_customizable',
        'stock_quantity',
        'is_active'
    ];
}
