<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use Illuminate\Http\Request;

use Carbon\Carbon;

class OrderController extends Controller
{
    protected $order;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->order = $orderRepository;
    }

    public function new()
    {
        $orders = $this->order->getPendingOrders();
        dd($orders);
        return view('pages.admin.orders.new');
    }

    public function getNewOrders()
    {
        $orderArray = [];

        $orders = $this->order->getPendingOrders();

        if(count($orders) > 0) {
            foreach($orders as $key => $order) {
                $orderArray[] = [
                    'id' => $order->id,
                    'user' => isset($order->user_id) ? $order->user->first_name . " " . $order->user->last_name : 'Guest User',
                    'order_num' => $order->order_number,
                    'date' => Carbon::parse($order->order_date)->toFormattedDateString(),
                    'total' => $order->total_amount,
                    'status' => $order->status,
                    'details' => $order->id
                ];
            }
        }

        return json_encode($orderArray);
    }
}
