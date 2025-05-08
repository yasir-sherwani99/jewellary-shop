<div class="seller pt-5 pt-md-6 pb-1 pb-lg-3 my-2 mt-0">
    <div class="container">
        <div class="heading heading-center mb-5">
            <h2 class="title text-uppercase mb-3">Best Sellers</h2>
            <ul class="nav nav-pills justify-content-center" role="tablist">
                <li class="nav-item d-none">
                    <a href="#seller-all" class="nav-link font-size-normal letter-spacing-large active" data-toggle="tab" role="tab">All</a>
                </li>
            </ul>
        </div>
        <div class="tab-content tab-content-carousel">
            <div class="tab-pane p-0 fade show active" id="seller-all" role="tabpanel">
                <div class="owl-carousel  carousel-equal-height owl-simple carousel-with-shadow row cols-lg-4 cols-md-3 cols-2" data-toggle="owl" data-owl-options='{
                    "nav": false,
                    "dots": true,
                    "margin": 20,
                    "loop": false,
                    "responsive": {
                        "0": {
                            "items": 2
                        },
                        "768": {
                            "items": 3
                        }, 
                        "992": {
                            "items": 4,
                            "nav": true
                        }
                    }
                }'>
                    @if(count($bestSellers) > 0)
                        @foreach($bestSellers as $prod)
                            <div class="product shadow-none">
                                <figure class="product-media">
                                    @if(strtotime($prod->created_at) >= strtotime(now()->subDays(30)))
                                        <span class="product-label label-new">New</span>
                                    @endif
                                    <a href="{{ route('product.show', $prod->slug) }}">
                                        @if(count($prod->images) > 0)
                                            @foreach($prod->images as $img)
                                                <img
                                                    src="{{ asset($img->image_url) }}"
                                                    alt="{{ $prod->name }}"
                                                    width="277"
                                                    height="377"
                                                    class="{{ $img->is_primary == 1 ? 'product-image' : 'product-image-hover' }}"
                                                />
                                            @endforeach
                                        @else
                                            <img
                                                src="{{ asset('assets/images/default/product_default_image.png') }}"
                                                alt="{{ $prod->name }}"
                                                width="277"
                                                height="377"
                                                class="product-image"
                                            />
                                        @endif
                                    </a>
                                    <div class="product-action-vertical">                                        
                                        <a 
                                            href="#" 
                                            class="btn-product-icon btn-wishlist add-to-wishlist"
                                            data-product-id="{{ $prod->id }}"
                                        >
                                            <span class="wishlist-text">add to wishlist</span>
                                        </a>
                                    </div>
                                </figure>
                                <div class="product-body text-center bg-light-2">
                                    <h3 class="product-title font-size-normal">{{ $prod->name }}</h3>
                                    <div class="product-price font-size-normal mb-0 text-dark justify-content-center">
                                        @if ($prod->discount_price)
                                            <span class="text-muted"><s>{{ 'Rs. ' . $prod->price }}</s></span>
                                            <span class="text-danger ml-3">{{ 'Rs. ' . $prod->discount_price }}</span>
                                        @else
                                            <span>{{ 'Rs. ' . $prod->price }}</span>
                                        @endif
                                    </div>
                                    <div class="product-footer justify-content-center d-block">
                                        <div class="ratings-container justify-content-center">
                                            <div class="ratings">
                                                <div class="ratings-val" style="width: 60%;"></div><!-- End .ratings-val -->
                                            </div><!-- End .ratings -->
                                            <span class="ratings-text">( {{ count($prod->reviews) }} Reviews )</span>
                                        </div>
                                        <a 
                                            href="#" 
                                            class="btn font-size-normal letter-spacing-large btn-dark add-to-cart"
                                            data-product-id="{{ $prod->id }}"
                                        >
                                            <i class="icon-cart-plus"></i>
                                            <span class="cart-text">ADD TO CART</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-center text-danger font-weight-normal">No product found!</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>