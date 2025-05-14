<table class="table table-bordered">
    <thead class="table-light">
        <tr>
            <th scope="col" class="text-center">#</th>
            <th scope="col">Product</th>
            <th scope="col">Price</th>
            <th scope="col" class="text-center">Qty.</th>
            <th scope="col" class="text-end pe-4">Total</th>
        </tr>
    </thead>
    <tbody>
        @if(count($order->items) > 0)
            @foreach($order->items as $key => $item)
                <tr>
                    <th class="align-middle text-center" scope="row">{{ $key + 1 }}</th>
                    <td class="align-middle">
                        <p class="mb-0">{{ $item->product ? $item->product->name : 'Product Title N/A' }}</p>
                        @if($item->product->sub_title)
                            <p class="text-muted mb-0">{{ $item->product->sub_title }}</p>
                        @endif
                    </td>
                    <td class="align-middle">{{ 'Rs.' . $item->unit_price }}</td>
                    <td class="align-middle text-center">{{ $item->quantity }}</td>
                    <td class="align-middle text-end pe-4">Rs. {{ $item->unit_price * $item->quantity }}</td> 
                </tr>
            @endforeach 
            <tr>
                <td colspan="5">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="4" class="text-end fw-semibold">Subtotal</td>
                <td class="text-end pe-4">{{ 'Rs. ' . $order->subtotal_amount }}</td>
            </tr>
            <tr>
                <td colspan="4" class="text-end fw-semibold">Shipping</td>
                <td class="text-end pe-4">{{ 'Rs. ' . $order->shipping_amount }}</td>
            </tr>
            <tr>
                <td colspan="4" class="text-end fw-bold">Tax</td>
                <td class="text-end pe-4">{{ 'Rs. ' . $order->tax_amount }}</td>
            </tr>
            <tr>
                <td colspan="4" class="text-end fw-bold">Disount</td>
                <td class="text-end pe-4">{{ 'Rs. ' . $order->discount_amount }}</td>
            </tr>
            <tr>
                <td colspan="4" class="text-end fw-bold">Total</td>
                <td class="text-end pe-4">{{ 'Rs. ' . $order->total_amount }}</td>
            </tr>
        @endif
    </tbody>
</table>