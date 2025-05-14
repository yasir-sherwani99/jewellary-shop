@extends('layouts.admin_app')

@section('style')

    <style>
        .tabulator .tabulator-table .tabulator-cell {
            overflow: unset !important;
        } 
    </style>

@endsection

@section('content')

    @include('layouts.partials.admin._breadcrumb', ['title' => "Order Details", 'section' => "Orders", 'page' => 'Order Details'])

    @if(session()->has('success'))
        <div class="alert alert-success border-0 alert-dismissible fade show" role="alert">
            <strong>Well done!</strong> {{ session()->get('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (count($errors) > 0)
        <div class="alert alert-danger alert-dismissible fade show">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <strong>Alert!</strong>
            <ul class="ps-2 mb-0 ms-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-8">
                    <div class="row">
                        <div class="col-12">
                            @include('pages.admin.orders.inc.cart_items', ['order' => $order])
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 border">
                            <h5>Details</h5>
                            @include('pages.admin.orders.inc.other_details', ['order' => $order])
                        </div>
                        @if(count($order->addresses) > 0)
                            @foreach($order->addresses as $address)
                                <div class="col-6 border">
                                    <h5>{{ $address->address_type == 'shipping' ? 'Shipping Address' : 'Billing Address' }}</h5>
                                    @include('pages.admin.orders.inc.shipping_details', ['address' => $address])
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="col-4">
                    <div class="card">
                        <div class="card-header bg-light">
                            <h4 class="card-title">Process Order</h4>
                        </div><!--end card-header-->
                        <div class="card-body">
                            @include('pages.admin.orders.inc.process_form', ['order' => $order])
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header bg-light">
                            <h4 class="card-title">Notes</h4>
                        </div><!--end card-header-->
                        <div class="card-body">
                            @include('pages.admin.orders.inc.notes', ['notes' => $order->notes])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection