<?php

namespace App\Repositories;

use App\Models\ShippingMethod;
use App\Repositories\Interfaces\ShippingMethodRepositoryInterface;
use Illuminate\Support\Facades\DB;

class ShippingMethodRepository implements ShippingMethodRepositoryInterface
{
    protected $shipping;

    /**
     * Create a new class instance.
     */
    public function __construct(ShippingMethod $shipping)
    {
        $this->shipping = $shipping;
    }

    public function find($id): ?\App\Models\ShippingMethod
    {
        return $this->shipping->find($id);
    }

    public function getShippingMethodById($shippingMethodId): ?\App\Models\ShippingMethod
    {
        return $this->shipping->find($shippingMethodId);
    }

    public function getActiveShippingMethods(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->shipping->active()->get();
    }

    public function getAllShippingMethods(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->shipping->get();
    }

    public function create($data): \App\Models\ShippingMethod
    {
        return $this->shipping->create($data);
    }

    public function update($data, $methodId): bool
    {
        $smethod = $this->find($methodId);

        return $smethod ? $smethod->update($data) : false;
    }

    public function setActiveShippingMethod($id): void
    {
        // Start transaction to avoid race conditions
        DB::transaction(function () use ($id) {
            ShippingMethod::where('active', 1)->update(['active' => 0]);

            ShippingMethod::where('id', $id)->update(['active' => 1]);
        });
    }

    public function getActiveShippingMethod(): ?\App\Models\ShippingMethod
    {
        return $this->shipping->active()->first();
    }
}
