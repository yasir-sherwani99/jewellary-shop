<?php

namespace App\Repositories;

use App\Models\Order;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use Illuminate\Support\Facades\DB;

class OrderRepository implements OrderRepositoryInterface
{
    protected $order;

    /**
     * Create a new class instance.
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function find($id): ?Order
    {
        return $this->order->find($id);
    }

    public function getOrderById($orderId): ?Order
    {
        return $this->order->with('items.product.images')->find($orderId);
    }

    public function create($data): int
    {
        $this->order->create($data);

        $id = DB::getPdo()->lastInsertId();
        
        return $id;
    }

    public function update($data, $orderId): bool
    {
        $orderr = $this->find($orderId);

        return $orderr ? $orderr->update($data) : false;
    }
}
