@extends('layouts.admin_app')

@section('style')

    <style>
        .tabulator .tabulator-table .tabulator-cell {
            overflow: unset !important;
        } 
    </style>

@endsection

@section('content')

    @include('layouts.partials.admin._breadcrumb', ['title' => "Categories", 'section' => "Categories", 'page' => 'List'])

    @if(session()->has('success'))
        <div class="alert alert-success border-0 alert-dismissible fade show" role="alert">
            <strong>Well done!</strong> {{ session()->get('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row d-flex align-items-center">
                        <div class="col-md-6">
                            <h4 class="card-title">Categories </h4>
                        </div>
                        <div class="col-md-6 text-end pt-1">
                            <a href="{{ route('admin.categories.create') }}">
                                <button type="button" class="btn btn-primary">
                                    <i class="mdi mdi-plus me-2"></i>
                                    Add Category
                                </button>
                            </a>
                        </div>
                    </div>
                </div><!--end card-header-->
                <div class="card-body">
                    <div class="table-responsive">
                        <div id="datatable-categories"></div>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

@endsection

@section('script')
    <script src="{{ asset('admin-assets/plugins/tabulator/tabulator.min.js') }}"></script>
    <script>

        let table = new Tabulator("#datatable-categories", {
            ajaxURL:"/admin/getAllCategories",
            layout:"fitColumns",      //fit columns to width of table
            responsiveLayout:"collapse",  //hide columns that dont fit on the table
            tooltips:false,            //show tool tips on cells
            pagination:"local",       //paginate the data
            paginationSize:25,         //allow 7 rows per page of data
            placeholder:"<h6>No Data Available</h6>",
            columns:[                 //define the table columns
                {title: '#', hozAlign:"center", width:70, formatter:"rownum"},
                {title:"Name", field:"name", headerTooltip:false, headerFilter:"input", widthGrow:3},
                {title:"Slug", field:"slug", headerTooltip:false, widthGrow:3},
                {title:"Products", field:"total_products", hozAlign:"left", widthGrow:2},
                {title:"Status", field:"active", widthGrow:2, formatter:"html"},
                {title:"Action", field:"action", hozAlign:"left", formatter:"html", widthGrow:2},
            ],
        });

    </script>
    <script src="{{ asset('admin-assets/plugins/sweet-alert2/sweetalert2.min.js') }}"></script>
    <script>
        
        const changeStatus = (catId) => {
    
            fetch(`/admin/categories/${catId}/status`, {
                method: 'GET',
                headers: {
                    "Content-Type": "application/json"
                }
            })
            .then(res => res.json())
            .then(data => { 
                
                const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                }
                            });

                Toast.fire({
                    icon: 'success',
                    title: data.message
                });

            })
            .catch(error => console.log(error))

        }
        
    </script>
@endsection