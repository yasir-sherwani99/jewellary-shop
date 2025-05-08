<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\CustomHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Repositories\Interfaces\OrderItemRepositoryInterface;

class DashboardController extends Controller
{
    protected $order;
    protected $product;
    protected $orderItem;

    public function __construct(
        OrderRepositoryInterface $orderRepository,
        ProductRepositoryInterface $productRepository,
        OrderItemRepositoryInterface $orderItemRepository
    ) {
        $this->order = $orderRepository;
        $this->product = $productRepository;
        $this->orderItem = $orderItemRepository;
    }
    
    public function getDashboard()
    {
        $stats = [];
        // stats
        $stats['total_sales'] = CustomHelper::formatNumber($this->order->getTotalRevenue(), 1);
        $stats['today_sales'] = $this->order->getTodayRevenue();
        $stats['total_orders'] = $this->order->getTotalOrders();
        $stats['today_orders'] = $this->order->getTodayOrders();
        
        // data for sales graph
        $salesGraphData = $this->getSalesGraphData();
        view()->share('salesGraphData', $salesGraphData);

        // best selling products
        $bestSellingProducts = $this->product->getBestSellingProducts();
     
        // last 7 days earnings report
        $earningReport = $this->orderItem->last7DaysSales();

        return view('pages.admin.dashboard.index', [
            'stats' => $stats,
            'bestSellingProducts' => $bestSellingProducts,
            'earningReport' => $earningReport
        ]);
    }

    public function getSalesGraphData()
    {
        // last one year 
        $months = now()->subMonths(11)->monthsUntil(now());
        $datesData = [];
        $salesArr = [];
        $salesDatesArr = [];

        foreach ($months as $mon) {
            
            $datesData[] = [
                'month' => $mon->month,
                'year' => $mon->year,
            ];

            $date = $mon->format('M Y');
        
            array_push($salesDatesArr, $date);
        
        }
       
        $salesArr['date'] = json_encode($salesDatesArr);
        $salesArr['sales'] = json_encode($this->order->getMonthWiseSales($datesData));

        return $salesArr;
    }
}
