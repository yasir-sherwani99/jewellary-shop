@extends('layouts.app')

@section('content')

    @include('pages.product.inc.breadcrumb')

    <div class="page-content">
        <div class="container">
            @include('pages.product.inc.product_details')

            @include('pages.product.inc.product_tabs')

            <h2 class="title text-center mb-4">You May Also Like</h2><!-- End .title text-center -->

            @include('pages.product.inc.similar_products')

        </div>
    </div>

@endsection