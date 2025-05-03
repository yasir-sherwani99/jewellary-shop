<div class="product-details-top mb-2">
    <div class="row">
        <div class="col-md-6">
            <div class="product-gallery">
                <div class="row">
                    @foreach($product->images as $img)
                        @if($img->is_primary == 1)
                            <figure class="product-main-image">
                                <img 
                                    id="product-zoom" 
                                    src="{{ asset($img->image_url) }}" 
                                    data-zoom-image="{{ asset($img->image_url) }}" 
                                    alt="{{ $product->name }}"
                                />

                                <a href="#" id="btn-product-gallery" class="btn-product-gallery">
                                    <i class="icon-arrows"></i>
                                </a>
                            </figure><!-- End .product-main-image -->
                        @endif
                    @endforeach
                    @if(count($product->images) > 0)
                        <div id="product-zoom-gallery" class="product-image-gallery">
                            @foreach($product->images as $img)
                                <a 
                                    href="#"
                                    class="product-gallery-item {{ $img->is_primary == 1 ? 'active' : '' }}"
                                    data-image="{{ asset($img->image_url) }}" 
                                    data-zoom-image="{{ asset($img->image_url) }}"
                                >
                                    <img src="{{ asset($img->image_url) }}" alt="{{ $product->name }}" />
                                </a>
                            @endforeach
                        </div><!-- End .product-image-gallery -->
                    @endif
                </div><!-- End .row -->
            </div><!-- End .product-gallery -->
        </div><!-- End .col-md-6 -->

        <div class="col-md-6">
            <div class="product-details">
                <h1 class="product-title">{{ $product->name }}</h1><!-- End .product-title -->

                <div class="ratings-container">
                    <div class="ratings">
                        <div class="ratings-val" style="width: 80%;"></div><!-- End .ratings-val -->
                    </div><!-- End .ratings -->
                    <a
                        href="#product-review-link" 
                        class="ratings-text" 
                        id="review-link"
                    >
                        ( {{ count($product->reviews) }} Reviews )
                    </a>
                </div><!-- End .rating-container -->

                <div class="product-price">
                    @if ($product->discount_price)
                        <span class="text-muted"><s>{{ 'Rs. ' . $product->price }}</s></span>
                        <span class="text-danger ml-3">{{ 'Rs. ' . $product->discount_price }}</span>
                    @else
                        <span>{{ 'Rs. ' . $product->price }}</span>
                    @endif
                </div><!-- End .product-price -->

                <div class="product-content">
                    <p>{{ $product->description }}</p>
                </div><!-- End .product-content -->

                <!-- <div class="details-filter-row details-row-size">
                    <label>Color:</label>

                    <div class="product-nav product-nav-thumbs">
                        <a href="#" class="active">
                            <img src="assets/images/products/single/1-thumb.jpg" alt="product desc">
                        </a>
                        <a href="#">
                            <img src="assets/images/products/single/2-thumb.jpg" alt="product desc">
                        </a>
                    </div>
                </div> -->

                <!-- <div class="details-filter-row details-row-size">
                    <label for="size">Size:</label>
                    <div class="select-custom">
                        <select name="size" id="size" class="form-control">
                            <option value="#" selected="selected">Select a size</option>
                            <option value="s">Small</option>
                            <option value="m">Medium</option>
                            <option value="l">Large</option>
                            <option value="xl">Extra Large</option>
                        </select>
                    </div>

                    <a href="#" class="size-guide"><i class="icon-th-list"></i>size guide</a>
                </div> -->

                <!-- <div class="details-filter-row details-row-size">
                    <label for="qty">Qty:</label>
                    <div class="product-details-quantity">
                        <input type="number" id="qty" class="form-control" value="1" min="1" max="10" step="1" data-decimals="0" required>
                    </div>
                </div> -->

                <div class="product-details-action">
                    <a 
                        href="#" 
                        class="btn-product btn-cart add-to-cart"
                        data-product-id="{{ $product->id }}"
                    >
                        <span class="cart-text">ADD TO CART</span>
                    </a>

                    <div class="details-action-wrapper">
                        <a 
                            href="#" 
                            class="btn-product btn-wishlist add-to-wishlist" 
                            title="Wishlist"
                            data-product-id="{{ $product->id }}"
                        >
                            <span class="wishlist-text">Add to Wishlist</span>
                        </a>
                        <a href="#" class="btn-product btn-compare" title="Compare"><span>Add to Compare</span></a>
                    </div><!-- End .details-action-wrapper -->
                </div><!-- End .product-details-action -->

                <div class="product-details-footer">
                    <div class="product-cat">
                        <span>Category:</span>
                        <a href="#">{{ $product->category->name }}</a>

                    </div><!-- End .product-cat -->

                    <div class="social-icons social-icons-sm">
                        <span class="social-label">Share:</span>
                        <a href="#" class="social-icon" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                        <a href="#" class="social-icon" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                        <a href="#" class="social-icon" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
                        <a href="#" class="social-icon" title="Pinterest" target="_blank"><i class="icon-pinterest"></i></a>
                    </div>
                </div><!-- End .product-details-footer -->
            </div><!-- End .product-details -->
        </div><!-- End .col-md-6 -->
    </div><!-- End .row -->
</div><!-- End .product-details-top -->