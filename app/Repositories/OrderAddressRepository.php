<?php

namespace App\Repositories;

use App\Models\OrderAddress;
use App\Repositories\Interfaces\OrderAddressRepositoryInterface;

class OrderAddressRepository implements OrderAddressRepositoryInterface
{
    protected $address;

    /**
     * Create a new class instance.
     */
    public function __construct(OrderAddress $address)
    {
        $this->address = $address;
    }
}
