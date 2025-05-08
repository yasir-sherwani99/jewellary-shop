<?php

namespace App\Repositories;

use App\Models\OrderItem;
use App\Repositories\Interfaces\OrderItemRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class OrderItemRepository implements OrderItemRepositoryInterface
{
    protected $order_item;

    /**
     * Create a new class instance.
     */
    public function __construct(OrderItem $order_item)
    {
        $this->order_item = $order_item;
    }

    public function last7DaysSales(): \Illuminate\Support\Collection
    {
        return DB::table('order_items')
                ->join('orders', 'order_items.order_id', '=', 'orders.id')
                ->selectRaw('DATE(order_items.created_at) as date')
                ->selectRaw('SUM(order_items.quantity * order_items.unit_price) as earnings')
                ->selectRaw('SUM(order_items.quantity) as items_sold')
                ->where('order_items.created_at', '>=', Carbon::now()->subDays(6)->startOfDay()) // last 7 days including today
                ->whereIn('orders.status', ['shipped', 'delivered'])
                ->groupByRaw('DATE(order_items.created_at)')
                ->orderByRaw('DATE(order_items.created_at)')
                ->get();
    }
}
