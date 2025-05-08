<div class="header-bottom sticky-header">
    <div class="container">
        <div class="header-left">
            <nav class="main-nav">
                <ul class="menu sf-arrows">
                    @foreach($mainNav as $nav)
                        <li class="{{ request()->is($nav['path']) ? 'active' : '' }}">
                            <a href="{{ $nav['route'] == '#' ? '#' : route($nav['route'], $nav['params'] ?? '') }}">{{ $nav['name'] }}</a>    
                            @if(isset($nav['children']))
                                <div class="megamenu megamenu-sm">
                                    <div class="row no-gutters">
                                        <div class="col-md-6">
                                            <div class="menu-col">
                                                <ul>
                                                    @foreach($nav['children'] as $child)
                                                        <li>
                                                            <a 
                                                                href="{{ $child['route'] == '#' ? '#' : $child['url'] }}"
                                                            >
                                                                {{ $child['name'] }}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="banner banner-overlay">
                                                <a href="#">
                                                    <img src="{{ asset('assets/images/menu/banner-2.jpg') }}" alt="Banner" />

                                                    <div class="banner-content banner-content-bottom">
                                                        <div class="banner-title text-white">New Trends<br><span><strong>spring 2025</strong></span></div><!-- End .banner-title -->
                                                    </div><!-- End .banner-content -->
                                                </a>
                                            </div><!-- End .banner -->
                                        </div><!-- End .col-md-6 -->
                                    </div>
                                </div>
                            @endif
                        </li>
                    @endforeach
                    
                </ul><!-- End .menu -->
            </nav><!-- End .main-nav -->

            <button class="mobile-menu-toggler">
                <span class="sr-only">Toggle mobile menu</span>
                <i class="icon-bars"></i>
            </button>
        </div><!-- End .header-left -->

        <div class="header-right">
            <i class="la la-lightbulb-o"></i><p class="text-white text-uppercase">Clearance Up to 30% Off</p>
        </div>
    </div><!-- End .container -->
</div><!-- End .header-bottom -->