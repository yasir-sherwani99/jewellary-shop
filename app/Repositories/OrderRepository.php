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
                    ->with(['shippingAddress'])
                    ->pending()
                    ->sort('desc')
                    ->get();
        
    }

    public function getCancelOrReturnedOrders(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->order
                    ->with(['shippingAddress'])
                    ->whereIn('status', ['cancelled', 'returned'])
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

    public function getOrderStats(): array
    {
        return [
            'total' => $this->order->count(),
            'pending' => $this->order->pending()->count(),
            'cancelled' => $this->order->whereIn('status', ['cancelled', 'returned'])->count(),
            'delivered' => $this->order->whereIn('status', ['shipped', 'delivered'])->count()
        ];
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

    public function getMonthWiseSales($datesData): array
    {
        $salesArr = [];
        foreach($datesData as $data) {
            // sum month wise sales
            $sales = $this->order
                          ->whereIn('status', ['shipped', 'delivered'])
                          ->whereMonth('order_date', $data['month'])
                          ->whereYear('order_date', $data['year'])
                          ->sum('total_amount');

            array_push($salesArr, $sales);
        }

		return $salesArr;
    }

    public function countMonthWiseOrders($datesData): array
    {
        $orderArr = [];
        foreach($datesData as $data) {
            // count month wise orders 
            $orders = $this->order
                            ->whereIn('status', ['shipped', 'delivered'])
                            ->whereMonth('order_date', $data['month'])
                            ->whereYear('order_date', $data['year'])
                            ->count();
            
            array_push($orderArr, $orders);
        }

		return $orderArr;
    }
}
