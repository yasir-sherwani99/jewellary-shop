@extends('layouts.app')

@section('content')
    
    @include('pages.home.inc.slider_section')

    @include('pages.home.inc.banner_section')

    @include('pages.home.inc.new_arrival_section')

    @include('pages.home.inc.best_seller_section')

    @include('pages.home.inc.banner2_section')

    <div class="container pt-3 pt-md-7 small-group">
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 col-sm-9 col-12 popular mb-3 mb-lg-0">
                @include('pages.home.inc.popular_products')
            </div>
            <div class="col-lg-4 col-md-10 col-12 lookbook order-lg-0 order-md-last mb-3 mb-lg-0">
                @include('pages.home.inc.lookbook')
            </div>
            <div class="col-lg-4 col-md-6 col-sm-9 col-12 service mb-3 mb-lg-0">
                @include('pages.home.inc.our_services')
            </div>
        </div>
    </div>

    @include('pages.home.inc.shop_instagram')

@endsection