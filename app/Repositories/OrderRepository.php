<?php

namespace App\Repositories;

use App\Models\Order;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use Carbon\Carbon;
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

    public function find($id): ?\App\Models\Order
    {
        return $this->order->find($id);
    }

    public function getOrderById($orderId): ?\App\Models\Order
    {
        return $this->order->with('items.product.images')->find($orderId);
    }

    public function getUserOrders($userId): \Illuminate\Database\Eloquent\Collection
    {
        return $this->order
                    ->with('items.product.images')
                    ->where('user_id', $userId)
                    ->sort('desc')
                    ->get();
    }

    public function getPendingOrders(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->order
                    ->with(['items.product.images', 'shippingAddress'])
                    ->pending()
                    ->sort('desc')
                    ->get();
        
    }

    public function getTotalRevenue(): float
    {
        return $this->order->whereIn('status', ['shipped', 'delivered'])->sum('total_amount');        
    }

    public function getTodayRevenue(): float
    {
        return $this->order
                    ->whereDate('order_date', Carbon::today())
                    ->whereIn('status', ['shipped', 'delivered'])
                    ->sum('total_amount');
    }

    public function getTotalOrders(): int
    {
        return $this->order->whereIn('status', ['shipped', 'delivered'])->count();
    }

    public function getTodayOrders(): int
    {
        return $this->order
                    ->whereDate('order_date', Carbon::today())
                    ->whereIn('status', ['shipped', 'delivered'])
                    ->count();
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

    public function getLastYearSalesMonthWise($periodData): array
    {
        $salesArr = [];
        foreach($periodData as $data) {
            // sum month wise orders data
            $sales = $this->order
                          ->whereIn('status', ['shipped', 'delivered'])
                          ->whereMonth('order_date', $data['month'])
                          ->whereYear('order_date', $data['year'])
                          ->sum('total_amount');

            array_push($salesArr, $sales);
        }

		return $salesArr;
    }
}
