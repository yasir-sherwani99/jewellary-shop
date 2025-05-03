<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaxRate extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'rate',
        'country',
        'active'
    ];

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */
    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    public function scopeForAddress($query, $country)
    {
        return $query->active()
            ->where(function($q) use ($country) {
                $q->whereNull('country')
                  ->orWhere('country', $country);
            })
            ->orderByDesc('country');
    }
}
