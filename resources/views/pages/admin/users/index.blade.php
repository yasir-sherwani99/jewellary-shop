@extends('layouts.admin_app')

@section('style')
    
    <style>
        .tabulator .tabulator-table .tabulator-cell {
            overflow: unset !important;
        }
    </style>

@endsection

@section('content')

    @include('layouts.partials.admin._breadcrumb', ['title' => "Users", 'section' => "Users", 'page' => 'List'])

    @if(session()->has('success'))
        <div class="alert alert-success border-0 alert-dismissible fade show" role="alert">
            <strong>Well done!</strong> {{ session()->get('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">                      
                            <h4 class="card-title">Users Growth</h4>                      
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-demo">
                        <div id="apex_line1" class="apex-charts"></div>
                    </div>                                        
                </div>
            </div>
        </div>
    </div>

        <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-6">
                    @include('common.stats_box', ['title' => 'Total Users', 'stats' => $stats['total_users'], 'icon' => 'fas fa-users'])
                </div>
                <div class="col-lg-6">
                    @include('common.stats_box', ['title' => 'Register Users', 'stats' => $stats['register_users'], 'icon' => 'fas fa-user-shield'])
                </div>
            </div>                            
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Users List</h4>
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
            ajaxURL:'/admin/getAllUsers',
            layout:"fitColumns",      //fit columns to width of table
            responsiveLayout:"collapse",  //hide columns that dont fit on the table
            tooltips:false,            //show tool tips on cells
            pagination:"local",       //paginate the data
            paginationSize:25,         //allow 7 rows per page of data
            placeholder:"<h6>No Data Available</h6>",
            columns:[                 //define the table column
                {title: 'User', field: "image", hozAlign:"left", vertAlign:"middle", formatter:"html", width:90},
                {title: "Name", field: "name", headerFilter: "input", vertAlign:"middle", widthGrow: 3},
                {title: "Email", field: "email", headerFilter: "input", vertAlign:"middle", widthGrow: 3},
                {title: "Orders", field: "total_orders", vertAlign:"middle", widthGrow:3},
                {title: "Action", field: "details", vertAlign:"middle", widthGrow:2, formatter:function(cell, formatterParams){
                    return `<a href="/user/${cell.getValue()}/profile"><button class="btn btn-secondary btn-sm" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">Details</button><a>`;
                }},
            ],
        });
    </script>
    <script src="{{ asset('admin-assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
    <script>
        (function() {

            let dates = "{{ $userDates }}";
            let userDates = JSON.parse(dates.replace(/&quot;/g, '"'));

            let data = "{{ $userData }}";
            let userData = JSON.parse(data.replace(/&quot;/g, ''));

            var options = {
                chart: {
                    height: 375,
                    type: 'line',
                    toolbar: {
                        show: false
                    }
                },
                stroke: {
                    width: 3,
                    curve: 'smooth'
                },
                series: [{
                    name: 'New Users',
                    data: userData
                }],
                xaxis: {
                    //  type: 'datetime',
                    categories: userDates,
                    axisBorder: {
                        show: true,
                        color: '#bec7e0',
                    },  
                    axisTicks: {
                        show: true,
                        color: '#bec7e0',
                    },    
                },
                colors:['#5766da'],
                markers: {
                    size: 3,
                    opacity: 0.9,
                    colors: ["#fdb5c8"],
                    strokeColors: '#fff',
                    strokeWidth: 1,
                    style: 'inverted', // full, hollow, inverted
                    hover: {
                        size: 5,
                    }
                },
                yaxis: {
                    min: 0,
                //    max: 4000,
                    tickAmount: 1,
                    title: {
                        text: 'Users',
                    },
                },
                grid: {
                    row: {
                        colors: ['transparent', 'transparent'], // takes an array which will be repeated on columns
                        opacity: 0.2
                    },
                    strokeDashArray: 3.5,
                },
                responsive: [{
                    breakpoint: 600,
                    options: {
                        chart: {
                            toolbar: {
                                show: false
                            }
                        },
                        legend: {
                            show: false
                        },
                    }
                }]
            }

            var chart = new ApexCharts(
                document.querySelector("#apex_line1"),
                options
            );

            chart.render();

        })(); 
        
    </script>
@endsection
