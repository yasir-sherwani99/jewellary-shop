<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingMethod extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'shipping_type',
        'description',
        'price',
        'active'
    ];

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */
    public function scopeShippingtype($query, $type)
    {
        return $query->where('shipping_type', $type);
    }

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }
}
