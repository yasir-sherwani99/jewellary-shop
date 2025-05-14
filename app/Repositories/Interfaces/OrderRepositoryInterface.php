<?php

namespace App\Repositories\Interfaces;

interface OrderRepositoryInterface
{
    public function find($id): ?\App\Models\Order;
    public function getOrderById($orderId): ?\App\Models\Order;
    public function getUserOrders($userId): \Illuminate\Database\Eloquent\Collection;
    public function getAllOrders(): \Illuminate\Database\Eloquent\Collection;
    public function getPendingOrders(): \Illuminate\Database\Eloquent\Collection;
    public function getCancelOrReturnedOrders(): \Illuminate\Database\Eloquent\Collection;
    public function getTotalRevenue(): float;
    public function getTodayRevenue(): float;
    public function getTotalOrders(): int;
    public function getTodayOrders(): int;
    public function getOrderStats(): array;
    public function create($data): \App\Models\Order;
    public function update($data, $orderId): bool;
    public function getMonthWiseSales($datesData): array;
    public function countMonthWiseOrders($datesData): array;
}
