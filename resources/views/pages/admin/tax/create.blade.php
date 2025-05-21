@extends('layouts.admin_app')

@section('style')
@endsection

@section('content')

    @include('layouts.partials.admin._breadcrumb', ['title' => "Add Tax Rate", 'section' => "Settings / Tax Rates", 'page' => 'Add'])

    @if(session()->has('success'))
        <div class="alert alert-success border-0 alert-dismissible fade show" role="alert">
            <strong>Well done!</strong> {{ session()->get('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(count($errors) > 0)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        <div class="col-sm-8">
            <div class="card">
                <div class="card-header bg-light">
                    <h4 class="card-title">Add Tax Rate</h4>
                </div><!--end card-header-->
                <div class="card-body">
                    <form method="POST" class="needs-validation" enctype="multipart/form-data" action="{{ route('admin.tax-rates.store') }}" novalidate>    
                        @csrf          
                        <div class="row mb-3">
                            <div class="col-12">
                                <label for="name" class="form-label fw-bold">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Enter name" required />
                                <div class="invalid-feedback">
                                    Tax name is a required field.
                                </div>
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col-12">
                                <label for="rate" class="form-label fw-bold">Rate <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="rate" name="rate" value="{{ old('rate') }}" step=".01" placeholder="Enter rate" required />
                                    <span class="input-group-text">%</span>
                                </div>
                                <div class="invalid-feedback">
                                    Rate is a required field.
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <label for="country" class="form-label fw-bold">Country <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="country" name="country" value="{{ old('country') }}" placeholder="Enter country" required />
                                <div class="invalid-feedback">
                                    Country is a required field.
                                </div>
                            </div>
                        </div>          
                        <div class="row mt-2">
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-success">Create Tax Rate</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
@endsection