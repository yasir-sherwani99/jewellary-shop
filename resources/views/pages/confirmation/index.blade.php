@extends('layouts.app')

@section('style')
    <style>
        ul.order_details{
            margin:0 0 3em;
            list-style:none
        }
        ul.order_details::after, ul.order_details::before{
            content: " ";
            display:table
        }
        ul.order_details::after{
            clear:both
        }
        ul.order_details li{
            float:left;
            margin-right:2em;
            text-transform:uppercase;
            font-size:1em;
            line-height:1;
            border-right:1px dashed #cfc8d8;
            padding-right:2em;
            margin-left:0;
            padding-left:0;
            list-style-type:none
        }
        ul.order_details li strong{
            display:block;
            font-size:1.2em;
            text-transform:none;
            font-weight: 600;
            line-height:1.5
        }
        ul.order_details li:last-of-type{
            border:none
        }

        .woocommerce-order-details{
            margin-bottom:2em
        }
        .woocommerce-order-details :last-child{
            margin-bottom:0
        }
        .woocommerce .woocommerce-customer-details address{font-style:normal;margin-bottom:0;border:1px solid rgba(0,0,0,.1);border-bottom-width:2px;border-right-width:2px;text-align:left;width:100%;border-radius:5px;padding:6px 12px}.woocommerce .woocommerce-customer-details .woocommerce-customer-details--email,.woocommerce .woocommerce-customer-details .woocommerce-customer-details--phone{margin-bottom:0;padding-left:1.5em}.woocommerce .woocommerce-customer-details .woocommerce-customer-details--phone::before{font-family:WooCommerce;speak:never;font-weight:400;font-variant:normal;text-transform:none;line-height:1;-webkit-font-smoothing:antialiased;margin-right:.618em;content:"\e037";text-decoration:none;margin-left:-1.5em;line-height:1.75;position:absolute}.woocommerce .woocommerce-customer-details .woocommerce-customer-details--email::before{font-family:WooCommerce;speak:never;font-weight:400;font-variant:normal;text-transform:none;line-height:1;-webkit-font-smoothing:antialiased;margin-right:.618em;content:"\e02d";text-decoration:none;margin-left:-1.5em;line-height:1.75;position:absolute}
    </style>
@endsection

@section('content')

    @include('common.page-header', ['title' => 'Order Confirmation', 'subTitle' => ''])

    <div class="page-content mt-4">
        <div class="checkout">
            <div class="container">

                <div class="alert alert-success border-0 mb-2" role="alert">
                    <strong>Thank you.</strong> Your order has been received.
                </div>

                <ul class="order_details">
                    <li class="order">
                        Order Number
                        <strong>{{ $order->order_number }}</strong>
                    </li>
                    <li class="date">
                        Date 
                        <strong>{{ $order->order_date }}</strong>
                    </li>
                    <li class="total">
                        Total 
                        <strong>{{ 'Rs. ' . $order->total_amount }}</strong>
                    </li>
                    <li class="method">
                        Payment Method
                        <strong>Cash on Delivery</strong>
                    </li>
                </ul>
                <div class="summary">
                    <h3 class="summary-title">Order Details</h3><!-- End .summary-title -->
                    <table class="table table-summary">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($order->items) > 0)
                                @foreach($order->items as $item)
                                    <tr>
                                        <td>
                                            <a href="#">{{ $item->product->name }} x {{ $item->quantity }}</a>
                                        </td>
                                        <td>{{ 'Rs. ' . $item->unit_price * $item->quantity }}</td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                        <tfoot>
                            <tr>
                                <td>Subtotal:</td>
                                <td>
                                    {{ 'Rs. ' . $order->subtotal_amount }}
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Shipping:</th>
                                <td>{{ 'Rs. ' . $order->shipping_amount }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Tax:</th>
                                <td>{{ 'Rs. ' . $order->tax_amount }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Total:</th>
                                <td>{{ 'Rs. ' . $order->total_amount }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection