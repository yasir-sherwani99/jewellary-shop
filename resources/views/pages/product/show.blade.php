@extends('layouts.app')

@section('content')

    @include('common.breadcrumb', ['section' => 'Product', 'page' => $product->name])

    <div class="page-content">
        <div class="container">
            
            @include('pages.product.inc.product_details', ['product' => $product])

            @include('pages.product.inc.product_tabs', ['product' => $product])

            <h2 class="title text-center mb-4">You May Also Like</h2><!-- End .title text-center -->

            @include('pages.product.inc.similar_products', ['relatedProducts' => $relatedProducts])

        </div>
    </div>

@endsection