<div class="header-middle">
    <div class="container">
        <div class="header-left d-lg-block d-none">
            <div class="header-search header-search-extended header-search-visible d-none d-lg-block">
                <a href="#" class="search-toggle" role="button"><i class="icon-search"></i></a>
                <form action="#" method="get">
                    <div class="header-search-wrapper search-wrapper-wide">
                        <label for="q" class="sr-only">Search</label>
                        <button class="btn font-size-normal letter-spacing-large btn-primary" type="submit"><i class="icon-search"></i></button>
                        <input type="search" class="form-control" name="q" id="q" placeholder="Search product ..." required>
                    </div><!-- End .header-search-wrapper -->
                </form>
            </div><!-- End .header-search -->
        </div>
        <div class="header-center d-block">
            <a href="index.html" class="logo align-items-center d-flex flex-column bg-white">
                <img src="assets/images/demos/demo-25/logo.png" alt="Molla Logo" width="82" height="20">
            </a>
        </div><!-- End .header-left -->

        <div class="header-right">
            <a href="wishlist.html" class="wishlist-link d-flex">
                <i class="icon-heart-o"></i>
                <span class="wishlist-count">3</span>
                <span class="wishlist-txt">My Wishlist</span>
            </a>

            <div class="dropdown cart-dropdown">
                <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                    <i class="icon-shopping-cart"></i>
                    <span class="cart-count">2</span>
                    <span class="cart-txt">$164,00</span>
                </a>

                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-cart-products">
                        <div class="product shadow-none">
                            <div class="product-cart-details">
                                <h4 class="product-title font-size-normal">
                                    <a href="product.html">Beige knitted elastic runner shoes</a>
                                </h4>

                                <span class="cart-product-info">
                                    <span class="cart-product-qty">1</span>
                                    x $84.00
                                </span>
                            </div><!-- End .product-cart-details -->

                            <figure class="product-image-container">
                                <a href="product.html" class="product-image">
                                    <img src="assets/images/products/cart/product-1.jpg" alt="product">
                                </a>
                            </figure>
                            <a href="#" class="btn-remove" title="Remove Product"><i class="icon-close"></i></a>
                        </div><!-- End .product -->

                        <div class="product shadow-none">
                            <div class="product-cart-details">
                                <h4 class="product-title font-size-normal">
                                    <a href="product.html">Blue utility pinafore denim dress</a>
                                </h4>

                                <span class="cart-product-info">
                                    <span class="cart-product-qty">1</span>
                                    x $76.00
                                </span>
                            </div><!-- End .product-cart-details -->

                            <figure class="product-image-container">
                                <a href="product.html" class="product-image">
                                    <img src="{{ asset('assets/images/products/cart/product-2.jpg') }}" alt="product" />
                                </a>
                            </figure>
                            <a href="#" class="btn-remove" title="Remove Product"><i class="icon-close"></i></a>
                        </div><!-- End .product -->
                    </div><!-- End .cart-product -->

                    <div class="dropdown-cart-total">
                        <span>Total</span>

                        <span class="cart-total-price">$160.00</span>
                    </div><!-- End .dropdown-cart-total -->

                    <div class="dropdown-cart-action">
                        <a href="cart.html" class="btn font-size-normal letter-spacing-large btn-primary">View Cart</a>
                        <a href="checkout.html" class="btn font-size-normal letter-spacing-large btn-outline-primary-2"><span>Checkout</span><i class="icon-long-arrow-right"></i></a>
                    </div><!-- End .dropdown-cart-total -->
                </div><!-- End .dropdown-menu -->
            </div><!-- End .cart-dropdown -->
        </div>
    </div><!-- End .container -->
</div><!-- End .header-middle -->