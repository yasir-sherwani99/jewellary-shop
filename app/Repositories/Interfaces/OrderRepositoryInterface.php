<?php

namespace App\Repositories\Interfaces;

interface OrderRepositoryInterface
{
    public function find($id): ?\App\Models\Order;
    public function getOrderById($orderId): ?\App\Models\Order;
    public function create($data): int;
    public function update($data, $orderId): bool;
}
