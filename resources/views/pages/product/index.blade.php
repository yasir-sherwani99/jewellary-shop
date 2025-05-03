@extends('layouts.app')

@section('content')

    @include('common.page-header', ['title' => 'Products', 'subTitle' => ''])

    @include('common.breadcrumb', ['section' => 'Product', 'page' => 'All'])

    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="toolbox">
                        <div class="toolbox-left">
                            <div class="toolbox-info">
                                Showing <span>9 of 56</span> Products
                            </div><!-- End .toolbox-info -->
                        </div><!-- End .toolbox-left -->

                        <div class="toolbox-right">
                            <div class="toolbox-sort">
                                <label for="sortby">Sort by:</label>
                                <div class="select-custom">
                                    <select name="sortby" id="sortby" class="form-control">
                                        <option value="popularity" selected="selected">Most Popular</option>
                                        <option value="rating">Most Rated</option>
                                        <option value="date">Date</option>
                                    </select>
                                </div>
                            </div><!-- End .toolbox-sort -->
                            <div class="toolbox-layout">
                                <a href="category-list.html" class="btn-layout">
                                    <svg width="16" height="10">
                                        <rect x="0" y="0" width="4" height="4" />
                                        <rect x="6" y="0" width="10" height="4" />
                                        <rect x="0" y="6" width="4" height="4" />
                                        <rect x="6" y="6" width="10" height="4" />
                                    </svg>
                                </a>

                                <a href="category-2cols.html" class="btn-layout">
                                    <svg width="10" height="10">
                                        <rect x="0" y="0" width="4" height="4" />
                                        <rect x="6" y="0" width="4" height="4" />
                                        <rect x="0" y="6" width="4" height="4" />
                                        <rect x="6" y="6" width="4" height="4" />
                                    </svg>
                                </a>

                                <a href="category.html" class="btn-layout active">
                                    <svg width="16" height="10">
                                        <rect x="0" y="0" width="4" height="4" />
                                        <rect x="6" y="0" width="4" height="4" />
                                        <rect x="12" y="0" width="4" height="4" />
                                        <rect x="0" y="6" width="4" height="4" />
                                        <rect x="6" y="6" width="4" height="4" />
                                        <rect x="12" y="6" width="4" height="4" />
                                    </svg>
                                </a>

                                <a href="category-4cols.html" class="btn-layout">
                                    <svg width="22" height="10">
                                        <rect x="0" y="0" width="4" height="4" />
                                        <rect x="6" y="0" width="4" height="4" />
                                        <rect x="12" y="0" width="4" height="4" />
                                        <rect x="18" y="0" width="4" height="4" />
                                        <rect x="0" y="6" width="4" height="4" />
                                        <rect x="6" y="6" width="4" height="4" />
                                        <rect x="12" y="6" width="4" height="4" />
                                        <rect x="18" y="6" width="4" height="4" />
                                    </svg>
                                </a>
                            </div><!-- End .toolbox-layout -->
                        </div><!-- End .toolbox-right -->
                    </div><!-- End .toolbox -->
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
                            <p>No product found!</p>
                        @endif
                    </div><!-- End .products -->

                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center">
                            <li class="page-item disabled">
                                <a class="page-link page-link-prev" href="#" aria-label="Previous" tabindex="-1" aria-disabled="true">
                                    <span aria-hidden="true"><i class="icon-long-arrow-left"></i></span>Prev
                                </a>
                            </li>
                            <li class="page-item active" aria-current="page"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item-total">of 6</li>
                            <li class="page-item">
                                <a class="page-link page-link-next" href="#" aria-label="Next">
                                    Next <span aria-hidden="true"><i class="icon-long-arrow-right"></i></span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <aside class="col-lg-3 order-lg-first">
                    <div class="sidebar sidebar-shop">
                        <div class="widget widget-clean">
                            <label>Filters:</label>
                            <a href="#" class="sidebar-filter-clear">Clean All</a>
                        </div><!-- End .widget widget-clean -->

                        <div class="widget widget-collapsible">
                            <h3 class="widget-title">
                                <a data-toggle="collapse" href="#widget-1" role="button" aria-expanded="true" aria-controls="widget-1">
                                    Category
                                </a>
                            </h3><!-- End .widget-title -->

                            <div class="collapse show" id="widget-1">
                                <div class="widget-body">
                                    <div class="filter-items filter-items-count">
                                        @foreach($categories as $category)
                                            <div class="filter-item">
                                                <div class="custom-control custom-checkbox">
                                                    <input 
                                                        type="checkbox" 
                                                        class="custom-control-input" 
                                                        name="category" 
                                                        id="cat-{{ $category->id }}"
                                                        value="{{ $category->id }}"
                                                    />
                                                    <label class="custom-control-label" for="cat-{{ $category->id }}">{{ $category->name }}</label>
                                                </div><!-- End .custom-checkbox -->
                                                <span class="item-count">{{ $category->products_count }}</span>
                                            </div><!-- End .filter-item -->
                                        @endforeach
                                    </div><!-- End .filter-items -->
                                </div><!-- End .widget-body -->
                            </div><!-- End .collapse -->
                        </div><!-- End .widget -->

                        <div class="widget widget-collapsible">
                            <h3 class="widget-title">
                                <a data-toggle="collapse" href="#widget-2" role="button" aria-expanded="true" aria-controls="widget-2">
                                    Size
                                </a>
                            </h3><!-- End .widget-title -->

                            <div class="collapse show" id="widget-2">
                                <div class="widget-body">
                                    <div class="filter-items">
                                        <div class="filter-item">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="size-1">
                                                <label class="custom-control-label" for="size-1">XS</label>
                                            </div><!-- End .custom-checkbox -->
                                        </div><!-- End .filter-item -->

                                        <div class="filter-item">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="size-2">
                                                <label class="custom-control-label" for="size-2">S</label>
                                            </div><!-- End .custom-checkbox -->
                                        </div><!-- End .filter-item -->

                                        <div class="filter-item">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" checked id="size-3">
                                                <label class="custom-control-label" for="size-3">M</label>
                                            </div><!-- End .custom-checkbox -->
                                        </div><!-- End .filter-item -->

                                        <div class="filter-item">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" checked id="size-4">
                                                <label class="custom-control-label" for="size-4">L</label>
                                            </div><!-- End .custom-checkbox -->
                                        </div><!-- End .filter-item -->

                                        <div class="filter-item">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="size-5">
                                                <label class="custom-control-label" for="size-5">XL</label>
                                            </div><!-- End .custom-checkbox -->
                                        </div><!-- End .filter-item -->

                                        <div class="filter-item">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="size-6">
                                                <label class="custom-control-label" for="size-6">XXL</label>
                                            </div><!-- End .custom-checkbox -->
                                        </div><!-- End .filter-item -->
                                    </div><!-- End .filter-items -->
                                </div><!-- End .widget-body -->
                            </div><!-- End .collapse -->
                        </div><!-- End .widget -->

                        <div class="widget widget-collapsible">
                            <h3 class="widget-title">
                                <a data-toggle="collapse" href="#widget-3" role="button" aria-expanded="true" aria-controls="widget-3">
                                    Colour
                                </a>
                            </h3><!-- End .widget-title -->

                            <div class="collapse show" id="widget-3">
                                <div class="widget-body">
                                    <div class="filter-colors">
                                        <a href="#" style="background: #b87145;"><span class="sr-only">Color Name</span></a>
                                        <a href="#" style="background: #f0c04a;"><span class="sr-only">Color Name</span></a>
                                        <a href="#" style="background: #333333;"><span class="sr-only">Color Name</span></a>
                                        <a href="#" class="selected" style="background: #cc3333;"><span class="sr-only">Color Name</span></a>
                                        <a href="#" style="background: #3399cc;"><span class="sr-only">Color Name</span></a>
                                        <a href="#" style="background: #669933;"><span class="sr-only">Color Name</span></a>
                                        <a href="#" style="background: #f2719c;"><span class="sr-only">Color Name</span></a>
                                        <a href="#" style="background: #ebebeb;"><span class="sr-only">Color Name</span></a>
                                    </div><!-- End .filter-colors -->
                                </div><!-- End .widget-body -->
                            </div><!-- End .collapse -->
                        </div><!-- End .widget -->

                        <div class="widget widget-collapsible">
                            <h3 class="widget-title">
                                <a data-toggle="collapse" href="#widget-4" role="button" aria-expanded="true" aria-controls="widget-4">
                                    Brand
                                </a>
                            </h3><!-- End .widget-title -->

                            <div class="collapse show" id="widget-4">
                                <div class="widget-body">
                                    <div class="filter-items">
                                        <div class="filter-item">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="brand-1">
                                                <label class="custom-control-label" for="brand-1">Next</label>
                                            </div><!-- End .custom-checkbox -->
                                        </div><!-- End .filter-item -->

                                        <div class="filter-item">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="brand-2">
                                                <label class="custom-control-label" for="brand-2">River Island</label>
                                            </div><!-- End .custom-checkbox -->
                                        </div><!-- End .filter-item -->

                                        <div class="filter-item">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="brand-3">
                                                <label class="custom-control-label" for="brand-3">Geox</label>
                                            </div><!-- End .custom-checkbox -->
                                        </div><!-- End .filter-item -->

                                        <div class="filter-item">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="brand-4">
                                                <label class="custom-control-label" for="brand-4">New Balance</label>
                                            </div><!-- End .custom-checkbox -->
                                        </div><!-- End .filter-item -->

                                        <div class="filter-item">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="brand-5">
                                                <label class="custom-control-label" for="brand-5">UGG</label>
                                            </div><!-- End .custom-checkbox -->
                                        </div><!-- End .filter-item -->

                                        <div class="filter-item">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="brand-6">
                                                <label class="custom-control-label" for="brand-6">F&F</label>
                                            </div><!-- End .custom-checkbox -->
                                        </div><!-- End .filter-item -->

                                        <div class="filter-item">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="brand-7">
                                                <label class="custom-control-label" for="brand-7">Nike</label>
                                            </div><!-- End .custom-checkbox -->
                                        </div><!-- End .filter-item -->

                                    </div><!-- End .filter-items -->
                                </div><!-- End .widget-body -->
                            </div><!-- End .collapse -->
                        </div><!-- End .widget -->

                        <div class="widget widget-collapsible">
                            <h3 class="widget-title">
                                <a data-toggle="collapse" href="#widget-5" role="button" aria-expanded="true" aria-controls="widget-5">
                                    Price
                                </a>
                            </h3><!-- End .widget-title -->

                            <div class="collapse show" id="widget-5">
                                <div class="widget-body">
                                    <div class="filter-price">
                                        <div class="filter-price-text">
                                            Price Range:
                                            <span id="filter-price-range"></span>
                                        </div><!-- End .filter-price-text -->

                                        <div id="price-slider"></div><!-- End #price-slider -->
                                    </div><!-- End .filter-price -->
                                </div><!-- End .widget-body -->
                            </div><!-- End .collapse -->
                        </div><!-- End .widget -->
                    </div><!-- End .sidebar sidebar-shop -->
                </aside><!-- End .col-lg-3 -->
            </div>
        </div>
    </div>

@endsection