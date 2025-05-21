<?php

namespace App\Repositories\Interfaces;

interface ShippingMethodRepositoryInterface
{
    public function find($id): ?\App\Models\ShippingMethod;
    public function getShippingMethodById($shippingMethodId): ?\App\Models\ShippingMethod;
    public function getActiveShippingMethods(): \Illuminate\Database\Eloquent\Collection;
    public function getAllShippingMethods(): \Illuminate\Database\Eloquent\Collection;
    public function create($data): \App\Models\ShippingMethod;
    public function update($data, $methodId): bool;
    public function setActiveShippingMethod($id): void;
    public function getActiveShippingMethod(): ?\App\Models\ShippingMethod;
}
