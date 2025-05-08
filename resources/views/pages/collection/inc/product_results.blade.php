<div class="products mb-3">
    @if(count($products) > 0)
        <div class="row justify-content-center">
            @foreach($products as $prod)
                <div class="col-6 col-md-4 col-lg-4">
                    <div class="product product-7 text-center">
                        <figure class="product-media">
                            @if(strtotime($prod->created_at) >= strtotime(now()->subDays(30)))
                                <span class="product-label label-new">New</span>
                            @endif
                            @if(count($prod->images) > 0)
                                @foreach($prod->images as $img)
                                    @if($img->is_primary == 1)
                                        <a href="{{ route('product.show', $prod->slug) }}">
                                            <img
                                                src="{{ asset($img->image_url) }}"
                                                alt="{{ $prod->name }}"
                                                class="product-image"
                                            />
                                        </a>
                                    @endif
                                @endforeach
                            @else
                                <img
                                    src="{{ asset('assets/images/default/product_default_image.png') }}"
                                    alt="{{ $prod->name }}"
                                    class="product-image"
                                />
                            @endif

                            <div class="product-action-vertical">
                                <a 
                                    href="#" 
                                    class="btn-product-icon btn-wishlist btn-expandable add-to-wishlist"
                                    data-product-id="{{ $prod->id }}"
                                >
                                    <span class="wishlist-text">add to wishlist</span>
                                </a>
                                <a href="popup/quickView.html" class="btn-product-icon btn-quickview" title="Quick view"><span>Quick view</span></a>
                                <a href="#" class="btn-product-icon btn-compare" title="Compare"><span>Compare</span></a>
                            </div><!-- End .product-action-vertical -->

                            <div class="product-action">
                                <a 
                                    href="#" 
                                    class="btn-product btn-cart add-to-cart"
                                    data-product-id="{{ $prod->id }}"
                                >
                                    <span class="cart-text">add to cart</span>
                                </a>
                            </div><!-- End .product-action -->
                        </figure><!-- End .product-media -->

                        <div class="product-body">
                            <div class="product-cat">
                                <a href="#">{{ $prod->category->name }}</a>
                            </div><!-- End .product-cat -->
                            <h3 class="product-title">
                                <a href="product.html">
                                    {{ $prod->name }}
                                </a>
                            </h3><!-- End .product-title -->
                            <div class="product-price">
                                @if ($prod->discount_price)
                                    <span class="text-muted"><s>{{ 'Rs. ' . $prod->price }}</s></span>
                                    <span class="text-danger ml-3">{{ 'Rs. ' . $prod->discount_price }}</span>
                                @else
                                    <span>{{ 'Rs. ' . $prod->price }}</span>
                                @endif
                            </div><!-- End .product-price -->
                            <div class="ratings-container">
                                <div class="ratings">
                                    <div class="ratings-val" style="width: 20%;"></div><!-- End .ratings-val -->
                                </div><!-- End .ratings -->
                                <span class="ratings-text">( {{ count($prod->reviews) }} Reviews )</span>
                            </div><!-- End .rating-container -->
                        </div><!-- End .product-body -->
                    </div><!-- End .product -->
                </div><!-- End .col-sm-6 col-lg-4 -->
            @endforeach
        </div><!-- End .row -->
    @else
        <p class="text-center text-danger font-weight-normal">No product found!</p>
    @endif
</div><!-- End .products -->