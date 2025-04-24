<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'payment_method',
        'order_date',
        'tracking_number',
        'total_amount',
        'shipping_amount',
        'tax_amount',
        'discount_amount',
        'grand_total_amount',
        'shipping_address_id',
        'billing_address_id',
        'notes',
        'status'
    ];
}
