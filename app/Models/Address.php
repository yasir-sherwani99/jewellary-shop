<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'address_type',
        'street_address',
        'city',
        'state',
        'postal_code',
        'country',
        'is_default'
    ];

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
    public function setCountryAttribute($value)
    {
        $this->attributes['country'] = ucfirst($value);
    }
}
