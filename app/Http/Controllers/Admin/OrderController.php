<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderProcessRequest;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;
// use Illuminate\Http\Request;

use Carbon\Carbon;

class OrderController extends Controller
{
    protected $order;
    protected $product;

    public function __construct(
        OrderRepositoryInterface $orderRepository,
        ProductRepositoryInterface $productRepository
    ) {
        $this->order = $orderRepository;
        $this->product = $productRepository;
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
                    'user' => $order->user->first_name . " " . $order->user->last_name,
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
                    'user' => $order->user->first_name . " " . $order->user->last_name,
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

    public function getOrdersLog()
    {
        $orderArray = [];

        $orders = $this->order->getAllOrders();

        if(count($orders) > 0) {
            foreach($orders as $key => $order) {
                $orderArray[] = [
                    'id' => $order->id,
                    'user' => $order->user->first_name . " " . $order->user->last_name,
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

    public function details($orderId)
    {
        $order = $this->order->getOrderById($orderId);
        if(!$order) {
            abort(404);
        }

        return view('pages.admin.orders.details', [
            'order' => $order
        ]);
    }

    public function process(OrderProcessRequest $request, $orderId)
    {
        $order = $this->order->getOrderById($orderId);
        if(!$order) {
            abort(404);
        }

        if($request->status != 'pending') {
            // update order status 
            $this->order->update(['status' => $request->status], $orderId);
        }

        if($request->status == "shipped") {
            // reduce stock for each ordered product
            foreach ($order->items as $item) {
                $product = $this->product->getProductById($item->product_id);

                if ($product) {
                    $product->decrement('stock_quantity', $item->quantity);
                }
            }

            // Send order confirmation email
            // $order->notify(new OrderConfirmation($order, $isNewUser));
        }   

        return redirect()->route('admin.orders.new')->with('success', 'Order processed successfully.');
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
