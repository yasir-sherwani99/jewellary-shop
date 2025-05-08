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
                                    @for($i = 0; $i < count($cats); $i++)
                                        {{ $cats[$i] == $category->id ? 'checked' : '' }}
                                    @endfor
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
                    <input type="hidden" name="min_price" id="min_price" value="{{ request('min_price', 0) }}" />
                    <input type="hidden" name="max_price" id="max_price" value="{{ request('max_price', 750) }}" />
                </div><!-- End .filter-price -->
            </div><!-- End .widget-body -->
        </div><!-- End .collapse -->
    </div><!-- End .widget -->
    <button type="button" class="btn btn-primary w-100 search" onClick="applyFilter()">Apply Filter</button>
    <!-- </form> -->
</div><!-- End .sidebar sidebar-shop -->

