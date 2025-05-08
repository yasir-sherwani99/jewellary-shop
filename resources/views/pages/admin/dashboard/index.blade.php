@extends('layouts.admin_app')

@section('content')

    @include('layouts.partials.admin._breadcrumb', ['title' => "Dashboard", 'page' => 'Dashboard'])

    <div class="row">
        <div class="col-lg-8">
            @include('pages.admin.dashboard.inc.sales_graph')   
        </div><!-- end col--> 
        <div class="col-lg-4">
            @include('pages.admin.dashboard.inc.total_sales_box', ['total_sales' => $stats['total_sales']])
            <div class="row">
                <div class="col-12 col-lg-6"> 
                    @include('pages.admin.dashboard.inc.stats_box', ['text' => 'Today\'s Sales', 'stats' => $stats['today_sales'], 'is_currency' => true])
                </div><!--end col-->
                <div class="col-12 col-lg-6"> 
                    @include('pages.admin.dashboard.inc.stats_box', ['text' => 'Today\'s Orders', 'stats' => $stats['today_orders'], 'is_currency' => false])                     
                </div><!--end col-->
                <div class="col-12 col-lg-6"> 
                    @include('pages.admin.dashboard.inc.stats_box', ['text' => 'Total Orders', 'stats' => $stats['total_orders'], 'is_currency' => false])                     
                </div><!--end col-->
                <div class="col-12 col-lg-6"> 
                                         
                </div><!--end col-->                                
            </div><!--end row-->  
            @include('pages.admin.dashboard.inc.invoices_form')                                          
        </div><!-- end col-->                                     
    </div><!--end row-->

    <div class="row">
        <div class="col-lg-6">
            @include('pages.admin.dashboard.inc.earning_report', ['earningReport' => $earningReport]) 
        </div> <!--end col-->   
        <div class="col-lg-6">
            @include('pages.admin.dashboard.inc.popular_products', ['bestSellingProducts' => $bestSellingProducts])
        </div> <!--end col-->                                                   
    </div><!--end row-->
@endsection

@section('script')

<script src="{{ asset('admin-assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
<script>
    // Bar chart
    (function() {
        var options = {
            chart: {
            height: 100,
            type: 'bar',
            toolbar: {
                show: false
            },
            },
            plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '50%',
            },
            },
            colors: ['#e5effe'],
            dataLabels: {
                enabled: false
            },
            
            
            stroke: {
                show: true,
                width: 2,
            },
            series: [{
                name: 'Income',
                data: [0, 160, 100, 210, 145, 400, 155, 210, 120, 275, 110, 200, 100, 90, 220, 100, 180, 140, 315, 130, 105, 165, 120, 160, 100, 210, 145, 400, 155, 210, 120]
            }],
            labels: ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11",
            "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", 
            "24", "25", "26", "27", "28", "29", "30", "31",],
            
            xaxis: {
            labels: {  
                show: false,  
            },

            axisTicks: {
                show: false,
            },
            },
            grid: {
            borderColor: '#e5effe',
            strokeDashArray: 2,
            xaxis: {
                lines: {
                    show: false,
                },
            },   
            yaxis: {
                lines: {
                    show: false,
                },
            },
            }, 
            legend: {
            show: false
            },
            tooltip: {
            marker: {
                show: true,
            },
            x: {
                show: false,
            }
            },
            yaxis: {
                labels: {
                show: false,
                    formatter: function (value) {
                        return "$" + value ;
                    },
                    offsetX: -12,
                    offsetY: 0, 
                },
            },
            fill: {
            opacity: 1,
            },
        };
        
        var chart = new ApexCharts(document.querySelector("#Revenu_Status_bar"), options);
        chart.render();
    })();
</script>
<script>
    const viewInvoices = () => {
        let year = document.getElementById('year').value;

        window.location.href = `/admin/orders/invoices?year=${year}`
    }
</script>
<script>
    (function() {

        let mainDate = "{{ $salesGraphData['date'] }}";
        let mainDates = JSON.parse(mainDate.replace(/&quot;/g, '"'));

        let newSales = "{{ $salesGraphData['sales'] }}";
        let newSalesData = JSON.parse(newSales.replace(/&quot;/g, ''));

        var options = {
            chart: {
                height: 340,
                type: 'area',
                toolbar: {
                    show: false
                },
            },
            colors: ['#2a76f4'],
            dataLabels: {
                enabled: false
            },
            markers: {
                discrete: [{
                    seriesIndex: 0,
                    dataPointIndex: 7,
                    fillColor: '#000',
                    strokeColor: '#000',
                    size: 5
                }, {
                    seriesIndex: 2,
                    dataPointIndex: 11,
                    fillColor: '#000',
                    strokeColor: '#000',
                    size: 4
                }]
            },
            
            stroke: {
                show: true,
                curve: 'smooth',
                width: 2,
                lineCap: 'square'
            },
            series: [{
                name: 'Sales',
                data: newSalesData
            }],
            labels: mainDates,
            
            yaxis: {
                labels: {      
                    offsetX: -12,
                    offsetY: 0,      
                }
            },
            grid: {
                borderColor: '#e0e6ed',
                strokeDashArray: 5,
                xaxis: {
                    lines: {
                        show: true
                    }
                },   
                yaxis: {
                    lines: {
                        show: false,
                    }
                },
            }, 
            legend: {
                show: false
            },
            tooltip: {
                marker: {
                    show: true,
                },
                x: {
                    show: false,
                }
            },
            yaxis: {
                labels: {
                    formatter: function (value) {
                        return "Rs." + value ;
                    }
                },
            },
            fill: {
                type:"gradient",
                gradient: {
                    type: "vertical",
                    shadeIntensity: 1,
                    inverseColors: !1,
                    opacityFrom: .28,
                    opacityTo: .05,
                    stops: [45, 100]
                }
            },
            responsive: [{
                breakpoint: 575,    
            }]
        };

        var chart = new ApexCharts(document.querySelector("#Revenu_Status"), options);
        chart.render();
        })();

</script>

@endsection