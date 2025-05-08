<div class="header-top">
    <div class="container">
        <div class="header-left">
            <div class="d-flex align-items-center d-md-block text-secondary font-weight-light">
                <a href="tel:#"><i class="icon-phone h6 text-secondary" style="margin-right: 8px;"></i>Call: +0123 456 789</a>
            </div><!-- End .top-menu -->
        </div><!-- End .header-left -->

        <div class="header-right">
            <div class="social-icons social-icons-color d-sm-flex d-none">
                <a href="#" class="social-icon social-facebook" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                <a href="#" class="social-icon social-twitter" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                <a href="#" class="social-icon social-pinterest" title="Instagram" target="_blank"><i class="icon-pinterest-p"></i></a>
                <a href="#" class="social-icon social-instagram" title="Pinterest" target="_blank"><i class="icon-instagram"></i></a>
            </div><!-- End .soial-icons -->
            <ul class="top-menu text-secondary">
                <li>
                    <a href="#">Links</a>
                    <ul>
                        <li class="account-links font-weight-normal">
                            @if(auth()->check()) 
                                <a href="{{ route('dashboard') }}"><i class="icon-user d-none d-lg-block"></i>Dashboard</a>
                            @else
                                <a href="{{ route('login') }}"><i class="icon-user d-none d-lg-block"></i>Login</a> 
                            @endif
                        </li>
                    </ul>
                </li>
            </ul><!-- End .top-menu -->
        </div><!-- End .header-right -->
    </div>
</div>