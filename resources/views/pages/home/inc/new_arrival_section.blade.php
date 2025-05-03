<div class="arrival bg-light-2 pt-5 pt-md-11 pb-1 pb-lg-3 my-2 mt-0">
    <div class="container">
        <div class="heading heading-center mb-5">
            <h2 class="title text-uppercase mb-4">New Arrivals</h2>
            <ul class="nav nav-pills justify-content-center" role="tablist">
                <li class="nav-item">
                    <a href="#arrival-all" class="nav-link font-size-normal letter-spacing-large active" data-toggle="tab" role="tab">All</a>
                </li>
                <li class="nav-item">
                    <a href="#arrival-rings" class="nav-link font-size-normal letter-spacing-large" data-toggle="tab" role="tab">Rings</a>
                </li>
                <li class="nav-item">
                    <a href="#arrival-necklace" class="nav-link font-size-normal letter-spacing-large" data-toggle="tab" role="tab">Necklace</a>
                </li>
                <li class="nav-item">
                    <a href="#arrival-earrings" class="nav-link font-size-normal letter-spacing-large" data-toggle="tab" role="tab">Earrings</a>
                </li>
            </ul>
        </div>
        <div class="tab-content tab-content-carousel">
            <div class="tab-pane p-0 fade show active" id="arrival-all" role="tabpanel">
                <div class="owl-carousel carousel-equal-height owl-simple carousel-with-shadow row cols-lg-4 cols-md-3 cols-2" data-toggle="owl" data-owl-options='{
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
                            "items": 4
                        },
                        "1500": {
                            "items": 4,
                            "nav": true
                        }
                    }
                }'>
                    @if(count($newArrivals) > 0)
                        @foreach($newArrivals as $prod)
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
                        <p>No product found!</p>
                    @endif
                </div>
            </div>
            <div class="tab-pane p-0 fade" id="arrival-rings" role="tabpanel">
                <div class="owl-carousel carousel-equal-height owl-simple carousel-with-shadow row cols-lg-4 cols-md-3 cols-2" data-toggle="owl" data-owl-options='{
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
                    <div class="product shadow-none">
                        <figure class="product-media">
                            <a href="#">
                                <img src="assets/images/demos/demo-25/product/product-1.jpg" alt="Product image" width="277" height="377" class="product-image" />
                                <img src="assets/images/demos/demo-25/product/product-1-2.jpg" alt="Product image" width="277" height="377" class="product-image-hover" />
                            </a>
                            <div class="product-action-vertical">
                                <a href="#" class="btn-product-icon btn-wishlist"><span>add to wishlist</span></a>
                            </div>
                        </figure>
                        <div class="product-body text-center bg-light-2">
                            <h3 class="product-title font-size-normal">Sterling Silver Mixed Metal<br>Cross Over Ring</h3>
                            <div class="product-price font-size-normal mb-0 text-dark justify-content-center">
                                <span>$530.00</span>
                            </div>
                            <div class="product-footer justify-content-center d-block">
                                <div class="ratings-container justify-content-center">
                                    <div class="ratings">
                                        <div class="ratings-val" style="width: 60%;"></div><!-- End .ratings-val -->
                                    </div><!-- End .ratings -->
                                    <span class="ratings-text">( 4 Reviews )</span>
                                </div>
                                <a href="#" class="btn font-size-normal letter-spacing-large btn-dark">
                                    <i class="icon-cart-plus"></i>
                                    <span>ADD TO CART</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane p-0 fade" id="arrival-necklace" role="tabpanel">
                <div class="owl-carousel carousel-equal-height owl-simple carousel-with-shadow row cols-lg-4 cols-md-3 cols-2" data-toggle="owl" data-owl-options='{
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
                    <div class="product shadow-none">
                        <figure class="product-media">
                            <a href="#">
                                <img src="assets/images/demos/demo-25/product/product-2.jpg" alt="Product image" width="277" height="377" class="product-image" />
                                <img src="assets/images/demos/demo-25/product/product-2-2.jpg" alt="Product image" width="277" height="377" class="product-image-hover" />
                            </a>
                            <div class="product-action-vertical">
                                <a href="#" class="btn-product-icon btn-wishlist"><span>add to wishlist</span></a>
                            </div>
                        </figure>
                        <div class="product-body text-center bg-light-2">
                            <h3 class="product-title font-size-normal">Silver Tone Multi Layer<br>Coin Detail Necklace</h3>
                            <div class="product-price font-size-normal mb-0 text-dark justify-content-center">
                                <span>$530.00</span>
                            </div>
                            <div class="product-footer justify-content-center d-block">
                                <div class="ratings-container justify-content-center">
                                    <div class="ratings">
                                        <div class="ratings-val" style="width: 60%;"></div><!-- End .ratings-val -->
                                    </div><!-- End .ratings -->
                                    <span class="ratings-text">( 4 Reviews )</span>
                                </div>
                                <a href="#" class="btn font-size-normal letter-spacing-large btn-dark">
                                    <i class="icon-cart-plus"></i>
                                    <span>ADD TO CART</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="product shadow-none">
                        <span class="product-label letter-spacing-large p-2 bg-dark text-white">SALE</span>
                        <figure class="product-media">
                            <a href="#">
                                <img src="assets/images/demos/demo-25/product/product-3.jpg" alt="Product image" width="277" height="377" class="product-image" />
                                <img src="assets/images/demos/demo-25/product/product-3-2.jpg" alt="Product image" width="277" height="377" class="product-image-hover" />
                            </a>
                            <div class="product-action-vertical">
                                <a href="#" class="btn-product-icon btn-wishlist"><span>add to wishlist</span></a>
                            </div>
                        </figure>
                        <div class="product-body text-center bg-light-2">
                            <h3 class="product-title font-size-normal">Gold/Silver/Rose Gold Tone<br>Heart Pendant Necklace</h3>
                            <div class="product-price font-size-normal mb-0 text-dark justify-content-center">
                                <div class="old-price mx-3">$325.00</div>
                                Now $265.00
                            </div>
                            <div class="product-footer justify-content-center d-block">
                                <div class="ratings-container justify-content-center">
                                    <div class="ratings">
                                        <div class="ratings-val" style="width: 60%;"></div><!-- End .ratings-val -->
                                    </div><!-- End .ratings -->
                                    <span class="ratings-text">( 4 Reviews )</span>
                                </div>
                                <a href="#" class="btn font-size-normal letter-spacing-large btn-dark">
                                    <i class="icon-cart-plus"></i>
                                    <span>ADD TO CART</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="product shadow-none">
                        <figure class="product-media">
                            <a href="#">
                                <img src="assets/images/demos/demo-25/product/product-5.jpg" alt="Product image" width="277" height="377" class="product-image" />
                                <img src="assets/images/demos/demo-25/product/product-5-2.jpg" alt="Product image" width="277" height="377" class="product-image-hover" />
                            </a>
                            <div class="product-action-vertical">
                                <a href="#" class="btn-product-icon btn-wishlist"><span>add to wishlist</span></a>
                            </div>
                        </figure>
                        <div class="product-body text-center bg-light-2">
                            <h3 class="product-title font-size-normal">Silver/Rose Gold Tone<br>Waves Drop Pendant</h3>
                            <div class="product-price font-size-normal mb-0 text-dark justify-content-center">
                                <span>$331.00</span>
                            </div>
                            <div class="product-footer justify-content-center d-block">
                                <div class="ratings-container justify-content-center">
                                    <div class="ratings">
                                        <div class="ratings-val" style="width: 60%;"></div><!-- End .ratings-val -->
                                    </div><!-- End .ratings -->
                                    <span class="ratings-text">( 4 Reviews )</span>
                                </div>
                                <a href="#" class="btn font-size-normal letter-spacing-large btn-dark">
                                    <i class="icon-cart-plus"></i>
                                    <span>ADD TO CART</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane p-0 fade" id="arrival-earrings" role="tabpanel">
                <div class="owl-carousel carousel-equal-height owl-simple carousel-with-shadow row cols-lg-4 cols-md-3 cols-2" data-toggle="owl" data-owl-options='{
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
                    <div class="product shadow-none">
                        <figure class="product-media">
                            <a href="#">
                                <img src="assets/images/demos/demo-25/product/product-4.jpg" alt="Product image" width="277" height="377" class="product-image" />
                                <img src="assets/images/demos/demo-25/product/product-4-2.jpg" alt="Product image" width="277" height="377" class="product-image-hover" />
                            </a>
                            <div class="product-action-vertical">
                                <a href="#" class="btn-product-icon btn-wishlist"><span>add to wishlist</span></a>
                            </div>
                        </figure>
                        <div class="product-body text-center bg-light-2">
                            <h3 class="product-title font-size-normal">White Beaded Circle Drop Earrings</h3>
                            <div class="product-price font-size-normal mb-0 text-dark justify-content-center">
                                <span>$265.00</span>
                            </div>
                            <div class="product-footer justify-content-center d-block">
                                <div class="ratings-container justify-content-center">
                                    <div class="ratings">
                                        <div class="ratings-val" style="width: 60%;"></div><!-- End .ratings-val -->
                                    </div><!-- End .ratings -->
                                    <span class="ratings-text">( 4 Reviews )</span>
                                </div>
                                <a href="#" class="btn font-size-normal letter-spacing-large btn-dark">
                                    <i class="icon-cart-plus"></i>
                                    <span>ADD TO CART</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

