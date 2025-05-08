<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Order extends Model
{
    public $incrementing = false; 
    protected $keyType = 'string';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'order_number',
        'user_id',
        'payment_method',
        'order_date',
        'tracking_number',
        'subtotal_amount',
        'shipping_amount',
        'tax_amount',
        'discount_amount',
        'total_amount',
        'shipping_address_id',
        'billing_address_id',
        'notes',
        'status'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'string'
    ];

    /*
    |--------------------------------------------------------------------------
    | Relations
    |--------------------------------------------------------------------------
    */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function shippingAddress()
    {
        return $this->belongsTo(Address::class, 'shipping_address_id');
    }

    public function billingAddress()
    {
        return $this->belongsTo(Address::class, 'billing_address_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */
    public function scopeSort($query, $value) 
    {
        return $query->orderBy('order_date', $value);
    }

    public function scopePending($query) 
    {
        return $query->where('status', 'pending');
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */
    public function getOrderDateAttribute($value)
    {
        $dt = Carbon::parse($value);
        return $dt->toFormattedDateString();
    }
}
