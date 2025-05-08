<div class="mobile-menu-container">
    <div class="mobile-menu-wrapper">
        <span class="mobile-menu-close"><i class="icon-close"></i></span>

        <form action="#" method="get" class="mobile-search">
            <label for="mobile-search" class="sr-only">Search</label>
            <input type="search" class="form-control" name="mobile-search" id="mobile-search" placeholder="Search in..." required>
            <button class="btn font-size-normal letter-spacing-large btn-primary" type="submit"><i class="icon-search"></i></button>
        </form>
        
        <nav class="mobile-nav">
            <ul class="mobile-menu">
                @foreach($mainNav as $nav)
                    <li class="{{ request()->is($nav['url']) ? 'active' : '' }}">
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
                                                            href="{{ $child['route'] == '#' ? '#' : route($child['route'], $child['params'] ?? '') }}"
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
            </ul>
        </nav><!-- End .mobile-nav -->

        <div class="social-icons">
            <a href="#" class="social-icon" target="_blank" title="Facebook"><i class="icon-facebook-f"></i></a>
            <a href="#" class="social-icon" target="_blank" title="Twitter"><i class="icon-twitter"></i></a>
            <a href="#" class="social-icon" target="_blank" title="Instagram"><i class="icon-instagram"></i></a>
            <a href="#" class="social-icon" target="_blank" title="Youtube"><i class="icon-youtube"></i></a>
        </div><!-- End .social-icons -->
    </div><!-- End .mobile-menu-wrapper -->
</div><!-- End .mobile-menu-container -->