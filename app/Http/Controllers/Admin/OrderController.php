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
                    'user' => $order->shippingAddress->first_name . " " . $order->shippingAddress->last_name,
                    'order_num' => $order->order_number,
                    'payment_method' => $order->payment_method,
                    'date' => Carbon::parse($order->order_date)->toFormattedDateString(),
                    'total' => $order->total_amount,
                    'status' => $order->status,
                    'details' => $order->id
                ];
            }
        }

        return json_encode($orderArray);
    }

    public function cancelOrReturned()
    {
        return view('pages.admin.orders.cancel');
    }

    public function getCancelOrReturnedOrders()
    {
        $orderArray = [];

        $orders = $this->order->getCancelOrReturnedOrders();

        if(count($orders) > 0) {
            foreach($orders as $key => $order) {
                $orderArray[] = [
                    'id' => $order->id,
                    'user' => $order->shippingAddress->first_name . " " . $order->shippingAddress->last_name,
                    'order_num' => $order->order_number,
                    'payment_method' => $order->payment_method,
                    'date' => Carbon::parse($order->order_date)->toFormattedDateString(),
                    'total' => $order->total_amount,
                    'status' => $order->status,
                    'details' => $order->id
                ];
            }
        }

        return json_encode($orderArray);        
    }

    public function log()
    {
        // get order stats
        $stats = $this->order->getOrderStats();
        // get order chart data
        $this->getOrdersChartData();

        return view('pages.admin.orders.log', [
            'stats' => $stats
        ]);
    }

    public function getOrdersChartData()
    {
        $months = now()->subMonths(12)->monthsUntil(now());
        $datesData = [];
        $orderDates = [];

        foreach ($months as $mon) {

            $datesData[] = [
                'month' => $mon->month,
                'year' => $mon->year,
            ];

            $date = $mon->format('M Y');
            array_push($orderDates, $date);
        }

        $orderDatesFinal = json_encode($orderDates);
        view()->share('orderDates', $orderDatesFinal);

        $orderData = json_encode($this->order->countMonthWiseOrders($datesData));
        view()->share('orderData', $orderData);
    }
}
