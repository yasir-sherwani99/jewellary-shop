<?php
    $page = $products->currentPage();
    $total = $products->total();
    $perPage = $products->perPage();
    $showingTotal = $page * $perPage;

    $currentShowing = $showingTotal > $total ? $total : $showingTotal;
    $showingStarted = $showingTotal - $perPage;

	$fullUrl = rawurldecode(url(request()->getRequestUri()));
	$tmpExplode = explode('?', $fullUrl);
	$fullUrlNoParams = current($tmpExplode); 
?>

@extends('layouts.app')
    
@section('content')

    @include('common.page-header', ['title' => 'Our Collections', 'subTitle' => ''])

    @include('common.breadcrumb', ['section' => 'Product', 'page' => 'Collections'])

    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">

                    @include('pages.collection.inc.toolbox', ['total' => $total, 'showingStarted' => $showingStarted, 'currentShowing' => $currentShowing])

                    @include('pages.collection.inc.product_results', ['products' => $products])

                    {{ $products->withQueryString()->links('vendor.pagination.custom') }} 

                </div>
                <aside class="col-lg-3 order-lg-first">

                    @include('pages.collection.inc.sidebar_shop', ['categories' => $categories, 'cats' => $cats])
                
                </aside><!-- End .col-lg-3 -->
            </div>
        </div>
    </div>

@endsection

@section('script')

<script>
    
    let fullUrlNoParams = "{{ $fullUrlNoParams }}";
        
    function applyFilter() 
    {
        let categories = "";
        
        $("input[type=checkbox][name=category]:checked").each(function (index, item) {
            if(index == $("input[type=checkbox][name=category]:checked").length - 1) {
                categories += item.value;
            } else {
                categories += item.value + ",";
            }
        });

        let url = "";
        if(categories) {
            url = fullUrlNoParams + '?cat=' + categories;
        } else {
            url = fullUrlNoParams;
        }

        window.location.href = url;
        
        return false;
    }

    document.addEventListener('DOMContentLoaded', function () {

        var slider = document.getElementById('price-slider');
        const minInput = document.getElementById('min_price').value;
        const maxInput = document.getElementById('max_price').value;

        noUiSlider.create(slider, {
            start: [ parseInt(minInput), parseInt(maxInput) ],
            connect: true,
            range: {
                'min': 0,
                'max': 1000
            },
            tooltips: true,
            format: {
                to: value => Math.round(value),
                from: value => parseInt(value)
            }
        });

        slider.noUiSlider.on('update', function (values) {
            minInput.value = values[0];
            maxInput.value = values[1];
        });

        // Optional: auto-submit form on slider stop
        slider.noUiSlider.on('change', function (values) {
            const min = values[0];
            const max = values[1];

            // Build new URL with query parameters
            const url = new URL(window.location.href);
            url.searchParams.set('min_price', min);
            url.searchParams.set('max_price', max);

            // Optional: Preserve other existing filters
            window.location.href = url.toString();
        });
    });

</script>

@endsection