@extends('layouts.admin_app')

@section('style')

    <style>
        .tabulator .tabulator-table .tabulator-cell {
            overflow: unset !important;
        } 
    </style>

@endsection

@section('content')

    @include('layouts.partials.admin._breadcrumb', ['title' => "Cancel / Return Orders", 'section' => "Orders", 'page' => 'Cancel / Return'])

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Orders List</h4>
                </div><!--end card-header-->
                <div class="card-body">
                    <div class="table-responsive">
                        <div id="datatable-orders"></div>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

@endsection

@section('script')
    <script src="{{ asset('admin-assets/plugins/tabulator/tabulator.min.js') }}"></script>
    <script>
        let table = new Tabulator("#datatable-orders", {
            height: "100%",
            ajaxURL:`/admin/orders/getCancelOrReturnedOrders`,
            layout:"fitColumns",      //fit columns to width of table
            responsiveLayout:"collapse",  //hide columns that dont fit on the table
            pagination:"local",       //paginate the data
            paginationSize:25,         //allow 7 rows per page of data
            placeholder:"<h6>No Data Available</h6>",
            columns:[                 //define the table columns
                {title: '#', hozAlign:"left", vertAlign:"middle", width:70, formatter:"rownum"},
            //    {formatter:printIcon, width:40, hozAlign:"center", cellClick:function(e, cell){alert("Printing row data for: " + cell.getRow().getData().invoice)}},
                {title: "Client Name", field: "user",  vertAlign:"middle", widthGrow:3},
                {title: "Order #", field: "order_num",  vertAlign:"middle", widthGrow:3},
                {title: "Payment",  field: "payment_method", hozAlign:"left", vertAlign:"middle", widthGrow:3, formatter:function(cell, formatterParams){
                    if(cell.getValue() === "cod") {
                        return 'Cash on Delivery';
                    } else if(cell.getValue() === "credit_card") {
                        return 'Credit Card';
                    } else if(cell.getValue() === "bank_transfer") {
                        return 'Bank Transfer';
                    } else if(cell.getValue() === "paypal") {
                        return 'Paypal';
                    } else {
                        return 'Unknown';
                    }
                }},
                {title: "Total", field: "total",  vertAlign:"middle", formatter:"money", widthGrow:2, formatterParams:{
                    decimal:".",
                    thousand:",",
                    symbol:"Rs.",
                    symbolBefore:"p",
                    precision:2,
                }},
                {title: "Status",  field: "status", hozAlign:"left", vertAlign:"middle", widthGrow:2, formatter:function(cell, formatterParams){
                    if(cell.getValue() === "pending") {
                        return '<span class="badge bg-warning">Pending</span>';
                    } else if(cell.getValue() === "shipped") {
                        return '<span class="badge bg-success">Shipped</span>';
                    } else if(cell.getValue() === "processing") {
                        return '<span class="badge bg-info">Processing</span>';
                    } else if(cell.getValue() === "cancelled") {
                        return '<span class="badge bg-danger">Cancelled</span>';
                    } else if(cell.getValue() === "delivered") {
                        return '<span class="badge bg-success">Delivered</span>';
                    } else if(cell.getValue() === "returned") {
                        return '<span class="badge bg-secondary">Returned</span>';
                    } else {
                        return '<span class="badge bg-warning">Unknown</span>';
                    }
                }},
                {title:"Date", field:"date", hozAlign:"left", vertAlign:"middle", widthGrow:2},
                {title: "Action", field: "details", vertAlign:"middle", widthGrow:2, formatter:function(cell, formatterParams){
                    return `<a href="/admin/orders/${cell.getValue()}/details"><button class="btn btn-secondary btn-sm" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">Details</button><a>`;
                }}
            ],
        });
    </script>
@endsection