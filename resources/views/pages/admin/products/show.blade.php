@extends('layouts.admin_app')

@section('content')

    @include('layouts.partials.admin._breadcrumb', ['title' => "Product Details", 'section' => "Products", 'page' => 'Details'])

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 align-self-center">
                            @if(count($product->images) > 0)
                                @foreach($product->images as $key => $image)
                                    <?php
                                        $imageUrl = asset($image->image_url);
                                    ?> 
                                    <img 
                                        src="{{ $imageUrl }}" 
                                        alt="{{ $product->name }}" 
                                        class="mx-auto img-fluid object-fit-cover" 
                                    />
                                    @break
                                @endforeach
                            @endif
                                    
                        </div><!--end col-->
                        <div class="col-lg-6 align-self-center">
                            <div class="">
                                <span class="badge badge-soft-danger font-13 fw-semibold mb-2">{{ $product->category->name }}</span>
                                <h5 class="font-24 mb-0">{{ $product->name }}</h5>
                                <p class="text-muted mb-2">{{ $product->slug }}</p> 
                                <ul class="list-inline mb-2">
                                    <li class="list-inline-item me-0"><i class="mdi mdi-star text-warning font-16"></i></li>
                                    <li class="list-inline-item me-0"><i class="mdi mdi-star text-warning font-16"></i></li>
                                    <li class="list-inline-item me-0"><i class="mdi mdi-star text-warning font-16"></i></li>
                                    <li class="list-inline-item me-0"><i class="mdi mdi-star text-warning font-16"></i></li>
                                    <li class="list-inline-item"><i class="mdi mdi-star-half text-warning font-16"></i></li>
                                    <li class="list-inline-item">0.0 (0 reviews)</li>
                                </ul>
                                <h6 class="font-20 fw-bold">
                                    @if ($product->discount_price)
                                        <span class="font-14 text-muted fw-semibold"><del>{{ 'Rs. ' . $product->price }}</del></span>
                                        <span>{{ 'Rs. ' . $product->discount_price }}</span>
                                    @else
                                        <span>{{ 'Rs. ' . $product->price }}</span>
                                    @endif
                                </h6>
                                <h6 class="font-13">Details:</h6> 
                                <div class="text-muted">
                                    {!! $product->description !!}
                                </div>                                                 
                                <h6 class="font-13">Additional Info:</h6> 
                                <div class="text-muted">
                                    {!! $product->additional_info !!}
                                </div>                                                                                                                                 
                            </div>
                        </div><!--end col-->                                            
                    </div><!--end row-->
                </div><!--end card-body-->
            </div><!--end card-->
        </div><!--end col-->
    </div><!--end row-->

@endsection