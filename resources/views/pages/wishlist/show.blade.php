@extends('layouts.app')

@section('content')

    @include('common.page-header', ['title' => 'My Wishlist', 'subTitle' => ''])
    
    @include('common.breadcrumb', ['section' => 'My Dashboard', 'page' => 'My Wishlist']) 

    <div class="page-content">
        <div class="dashboard">
            <div class="container">
                <div class="row">
                    <aside class="col-md-4 col-lg-3">
                        @include('common.sidebar')
                    </aside>
                    <div class="col-md-8 col-lg-9">
                        @if(count($wishlists) > 0)
                            <table class="table table-wishlist table-mobile">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody class="wishlist-items">
                                    @foreach($wishlists as $list)
                                        <tr class="wishlist-item" data-item-id="{{ $list->id }}">
                                            <td class="product-col">
                                                <div class="product">
                                                    @if(count($list->product->images) > 0)
                                                        @foreach($list->product->images as $img)
                                                            <figure class="product-media">
                                                                <a href="#">
                                                                    <img 
                                                                        src="{{ asset($img->image_url) }}" 
                                                                        alt="{{ $list->product->name }}"
                                                                    />
                                                                </a>
                                                            </figure>
                                                            @break
                                                        @endforeach
                                                    @endif
                                                    <h3 class="product-title">
                                                        <a href="{{ route('product.show', $list->product->slug) }}">{{ $list->product->name }}</a>
                                                    </h3><!-- End .product-title -->
                                                </div><!-- End .product -->
                                            </td>
                                            <td class="price-col">
                                                @if ($list->product->discount_price)
                                                    <span class="text-muted"><s>{{ 'Rs. ' . $list->product->price }}</s></span>
                                                    <br />
                                                    <span class="text-danger">{{ 'Rs. ' . $list->product->discount_price }}</span>
                                                @else
                                                    <span>{{ 'Rs. ' . $list->product->price }}</span>
                                                @endif
                                            </td>
                                            <td class="remove-col remove-wishlist-item" data-product-id="{{ $list->product->id }}">
                                                <button class="btn-remove"><i class="icon-close"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p>Your wishlist is empty.</p>
                        @endif
                    </div><!-- End .col-lg-9 -->
                </div>
            </div>
        </div>
    </div>

@endsection