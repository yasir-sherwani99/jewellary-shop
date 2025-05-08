@if(count($orders) > 0)
    <table class="table table-wishlist table-mobile">
        <thead>
            <tr>
                <th>Order #</th>
                <th>Date</th>
                <th>Total</th>
                <th class="text-center">Status</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->order_number }}</td>
                    <td>{{ $order->order_date }}</td>
                    <td>{{ 'Rs. ' . $order->total_amount }}</td>
                    <td class="text-center">
                        @if($order->status == "pending")
                            <span class="text-warning">Pending</span>
                        @elseif($order->status == "shipped")
                            <span class="text-primary">Shipped</span>
                        @elseif($order->status == "delivered")
                            <span class="text-success">Delivered</span>
                        @elseif($order->status == "cancelled")
                            <span class="text-danger">Cancelled</span>
                        @elseif($order->status == "returned")
                            <span class="text-danger">Returned</span>
                        @endif
                    </td>
                    <td class="text-right">
                        <button class="btn btn-primary">Details</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p>No order has been made yet.</p>
    <a href="{{ route('product.collection') }}" class="btn btn-outline-primary-2"><span>GO SHOP</span><i class="icon-long-arrow-right"></i></a>
@endif