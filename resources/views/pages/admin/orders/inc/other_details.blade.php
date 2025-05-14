<p class="fw-bold mb-0">Order #: <span class="fw-light">{{ $order->order_number }}</span></p> 
<p class="fw-bold mb-0">Tracking ID: <span class="fw-light">{{ $order->tracking_number }}</span></p> 
<p class="fw-bold mb-0">Payment Method: <span class="fw-light">{{ $order->payment_method }}</span></p> 
<p class="fw-bold mb-0">Order Date: <span class="fw-light">{{ $order->order_date }}</span></p> 
<p class="fw-bold mb-0">
    Status:
    @if($order->status == "processing") 
        <span class="text-info">Processing</span> 
    @elseif($order->status == "pending")
        <span class="text-warning">Pending</span>
    @elseif($order->status == "delivered")
        <span class="text-success">Delivered</span>
    @elseif($order->shipping_status == "shipped")
        <span class="text-success">Shipped</span>
    @elseif($order->shipping_status == "cancelled")
        <span class="text-danger">Cancel</span>
    @elseif($order->shipping_status == "returned")
        <span class="text-danger">Return</span>
    @else
        <span class="text-danger">N/A</span>
    @endif
</p>