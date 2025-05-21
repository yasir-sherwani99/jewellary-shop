@extends('layouts.admin_app')

@section('style')
@endsection

@section('content')

    @include('layouts.partials.admin._breadcrumb', ['title' => "Shipping Methods", 'section' => "Settings / Shipping Methods", 'page' => 'List'])

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
                    <div class="row d-flex align-items-center">
                        <div class="col-md-6">
                            <h4 class="card-title">Shipping Methods </h4>
                        </div>
                        <div class="col-md-6 text-end pt-1">
                            <a href="{{ route('admin.shipping-methods.create') }}">
                                <button type="button" class="btn btn-primary">
                                    <i class="mdi mdi-plus me-2"></i>
                                    Add Shipping Method
                                </button>
                            </a>
                        </div>
                    </div>
                </div><!--end card-header-->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($shippingMethods) > 0)
                                    @foreach($shippingMethods as $key => $method)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>
                                                <a href="#">{{ $method->name }}</a>
                                            </td>
                                            <td>
                                                {{ 'Rs. ' . $method->price }}
                                            </td>
                                            <td> 
                                                <form action="{{ route('admin.shipping-methods.toggle', $method->id) }}" method="POST" id="toggle-form-{{ $method->id }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <div class="form-check form-switch">
                                                        <input 
                                                            class="form-check-input" 
                                                            type="checkbox" 
                                                            onChange="document.getElementById('toggle-form-{{ $method->id }}').submit();"
                                                            {{ $method->active == 1 ? 'checked' : '' }}
                                                        />
                                                    </div>
                                                </form>
                                            </td>
                                            <td class="text-end">                                                       
                                                <a href="{{ route('admin.shipping-methods.edit', $method->id) }}">
                                                    <i class="las la-pen text-secondary font-16"></i>
                                                </a>
                                                <form 
                                                    action="{{ route('admin.shipping-methods.delete', $method->id) }}" 
                                                    method="post"
                                                    onsubmit="return confirm('Are you sure?');"
                                                    class="d-inline"
                                                >                             
                                                    @csrf
                                                    @method('delete')

                                                    <button type="submit" class="border-0 bg-transparent">
                                                        <i class="las la-trash-alt text-secondary font-16"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6" class="text-center">No shipping method found!</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table><!--end /table-->
                    </div><!--end /tableresponsive-->
                </div><!--end card-body-->
            </div><!--end card-->
        </div> <!-- end col -->
    </div>

@endsection

@section('script')
@endsection