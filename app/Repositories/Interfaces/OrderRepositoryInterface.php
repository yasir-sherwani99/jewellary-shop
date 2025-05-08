<?php

namespace App\Repositories\Interfaces;

interface OrderRepositoryInterface
{
    public function find($id): ?\App\Models\Order;
    public function getOrderById($orderId): ?\App\Models\Order;
    public function getUserOrders($userId): \Illuminate\Database\Eloquent\Collection;
    public function getPendingOrders(): \Illuminate\Database\Eloquent\Collection;
    public function getTotalRevenue(): float;
    public function getTodayRevenue(): float;
    public function getTotalOrders(): int;
    public function getTodayOrders(): int;
    public function create($data): int;
    public function update($data, $orderId): bool;
    public function getLastYearSalesMonthWise($periodData): array;
}
