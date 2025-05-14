@extends('layouts.admin_app')

@section('style')
    
    <style>
        .tabulator .tabulator-table .tabulator-cell {
            overflow: unset !important;
        }
    </style>

@endsection

@section('content')

    @include('layouts.partials.admin._breadcrumb', ['title' => "Products", 'section' => "Products", 'page' => 'List'])

    @if(session()->has('success'))
        <div class="alert alert-success border-0 alert-dismissible fade show" role="alert">
            <strong>Well done!</strong> {{ session()->get('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-3">
                    @include('common.stats_box', ['title' => 'Total Products', 'stats' => $stats['total_products'], 'icon' => 'fa fa-boxes'])
                </div>
                <div class="col-lg-3">
                    @include('common.stats_box', ['title' => 'Active Products', 'stats' => $stats['active_products'], 'icon' => 'fa fa-box'])
                </div>
                <div class="col-lg-3">
                    @include('common.stats_box' , ['title' => 'In Stock Products', 'stats' => $stats['in_stock_products'], 'icon' => 'fas fa-cart-plus'])
                </div>
                <div class="col-lg-3">
                    @include('common.stats_box' , ['title' => 'Out of Stock Products', 'stats' => $stats['out_of_stock_products'], 'icon' => 'fa fa-ban'])
                </div>
            </div>                            
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Products List</h4>
                </div><!--end card-header-->
                <div class="card-body">
                    <div class="table-responsive">
                        <div id="datatable-products"></div>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

@endsection

@section('script')
    <script src="{{ asset('admin-assets/plugins/tabulator/tabulator.min.js') }}"></script>
    <script>
        let table = new Tabulator("#datatable-products", {
            ajaxURL:'/admin/getAllProducts',
            layout:"fitColumns",      //fit columns to width of table
            responsiveLayout:"collapse",  //hide columns that dont fit on the table
            tooltips:false,            //show tool tips on cells
            pagination:"local",       //paginate the data
            paginationSize:25,         //allow 7 rows per page of data
            placeholder:"<h6>No Data Available</h6>",
            columns:[                 //define the table columns
                {title: "Image", field: "image", hozAlign:"left", vertAlign:"middle", formatter:"html", width:100},
                {title: "Name", field: "name", headerFilter: "input", vertAlign:"middle", widthGrow: 3, formatter:function(cell, formatterParams){
                        return cell.getValue();
                }},
                {title: "Price", field: "price",  vertAlign:"middle", formatter:"money", widthGrow:2, formatterParams:{
                    decimal:".",
                    thousand:",",
                    symbol:"Rs. ",
                    symbolBefore:"p",
                    precision:2,
                }},
                {title: "Stock", field: "stock", vertAlign:"middle", widthGrow: 2, formatter:function(cell, formatterParams){
                        return cell.getValue();
                }},
                {title: "Category", field: "category",  vertAlign:"middle", widthGrow:2},
                {title: "Published", field:"published", hozAlign:"left", vertAlign:"middle", formatter:"tickCross", widthGrow:2, sorter:"boolean"},
                {title: "Action", field: "details", vertAlign:"middle", widthGrow:2, download:false, formatter:function(cell, formatterParams){
                    return `<button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Action <i class="mdi mdi-chevron-down"></i></button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="/admin/products/${cell.getValue()}/edit">Edit Product</a>
                                    <a class="dropdown-item" href="/admin/products/${cell.getValue()}">View Product</a>
                                </div>`
                }}
            ],
        });
    </script>
@endsection
