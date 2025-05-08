<div class="toolbox">
    <div class="toolbox-left">
        <div class="toolbox-info">
            Showing <span>{{ $total > 0 ? $showingStarted + 1 : $showingStarted }} - {{ $currentShowing }} of {{ $total }}</span> Products
        </div><!-- End .toolbox-info -->
    </div><!-- End .toolbox-left -->

    <div class="toolbox-right">
        <div class="toolbox-sort">
            <label for="sort">Sort by:</label>
            <form method="GET" action="{{ route('product.collection') }}" id="filterForm">
                <div class="select-custom">
                    <select name="sort" id="sort" onchange="document.getElementById('filterForm').submit()" class="form-control">
                        <option value="">Sort By</option>
                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest</option>
                        <option value="rating">Most Rated</option>
                        <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price Low</option>
                        <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price High</option>
                    </select>
                </div>
            </form>
        </div><!-- End .toolbox-sort -->
        <div class="toolbox-layout">
            <a href="#" class="btn-layout">
                <svg width="16" height="10">
                    <rect x="0" y="0" width="4" height="4" />
                    <rect x="6" y="0" width="10" height="4" />
                    <rect x="0" y="6" width="4" height="4" />
                    <rect x="6" y="6" width="10" height="4" />
                </svg>
            </a>

            <a href="#" class="btn-layout">
                <svg width="10" height="10">
                    <rect x="0" y="0" width="4" height="4" />
                    <rect x="6" y="0" width="4" height="4" />
                    <rect x="0" y="6" width="4" height="4" />
                    <rect x="6" y="6" width="4" height="4" />
                </svg>
            </a>

            <a href="#" class="btn-layout active">
                <svg width="16" height="10">
                    <rect x="0" y="0" width="4" height="4" />
                    <rect x="6" y="0" width="4" height="4" />
                    <rect x="12" y="0" width="4" height="4" />
                    <rect x="0" y="6" width="4" height="4" />
                    <rect x="6" y="6" width="4" height="4" />
                    <rect x="12" y="6" width="4" height="4" />
                </svg>
            </a>

            <a href="#" class="btn-layout">
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