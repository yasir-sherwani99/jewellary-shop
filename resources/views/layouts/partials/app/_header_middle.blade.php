<div class="header-middle">
    <div class="container">
        <div class="header-left d-lg-block d-none">
            <div class="header-search header-search-extended header-search-visible d-none d-lg-block">
                <a href="#" class="search-toggle" role="button"><i class="icon-search"></i></a>
                <form action="{{ route('product.collection') }}" method="GET">
                    <div class="header-search-wrapper search-wrapper-wide">
                        <label for="search" class="sr-only">Search</label>
                        <button class="btn font-size-normal letter-spacing-large btn-primary" type="submit"><i class="icon-search"></i></button>
                        <input type="search" class="form-control" name="search" id="search" value="{{ request('search') }}" placeholder="Search products..." required />
                    </div><!-- End .header-search-wrapper -->
                </form>
            </div><!-- End .header-search -->
        </div>
        <div class="header-center d-block">
            <a href="{{ route('home') }}" class="logo align-items-center d-flex flex-column bg-white">
                <img src="{{ asset('assets/images/demos/demo-25/logo.png') }}" alt="Molla Logo" width="82" height="20" />
            </a>
        </div><!-- End .header-left -->

        <div class="header-right">
            <a href="{{ route('wishlist.show') }}" class="wishlist-link d-flex">
                <i class="icon-heart-o"></i>
                <span class="wishlist-count" id="header-wishlist-count">0</span>
                <span class="wishlist-txt">My Wishlist</span>
            </a>

            <div class="dropdown cart-dropdown">
                <a href="{{ route('cart.index') }}" class="dropdown-toggle">
                    <i class="icon-shopping-cart"></i>
                    <span class="cart-count" id="header-cart-count">0</span>
                    <span class="cart-txt" id="header-cart-total">Rs. 0</span>
                </a>
            </div><!-- End .cart-dropdown -->
        </div>
    </div><!-- End .container -->
</div><!-- End .header-middle -->