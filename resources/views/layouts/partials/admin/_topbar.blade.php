<!-- Top Bar Start -->
<div class="topbar">            
    <!-- Navbar -->
    <nav class="navbar-custom" id="navbar-custom">    
        <ul class="list-unstyled topbar-nav float-end mb-0">
            <li class="dropdown">
                <a class="nav-link dropdown-toggle nav-user" data-bs-toggle="dropdown" href="#" role="button"
                    aria-haspopup="false" aria-expanded="false">
                    <div class="d-flex align-items-center">
                        <img 
                            src="{{ asset(auth()->guard('admin')->user()->photo) }}" 
                            alt="profile-user" 
                            class="rounded-circle me-2 thumb-sm" 
                            onerror="this.onerror=null;this.src='{{ asset('admin-assets/images/users/user-vector.png') }}';" 
                        />
                        <div>
                            <small class="d-none d-md-block font-11">Admin</small>
                            <span class="d-none d-md-block fw-semibold font-12">{{ auth()->guard('admin')->user()->name }}
                                <i class="mdi mdi-chevron-down"></i>
                            </span>
                        </div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="{{ route('admin.admins.edit', auth()->guard('admin')->user()->id) }}">
                        <i class="ti ti-user font-16 me-1 align-text-bottom"></i> Edit Profile
                    </a>
                    <a class="dropdown-item" href="{{ route('admin.password.create') }}"><i class="ti ti-settings font-16 me-1 align-text-bottom"></i> Password</a>
                    <div class="dropdown-divider mb-0"></div>
                    <a 
                        class="dropdown-item" 
                        href="#"
                        onclick="
                                event.preventDefault(); 
                                document.getElementById('admin-logout-form-top').submit();
                            "
                    >
                        <i class="ti ti-power font-16 me-1 align-text-bottom"></i> Logout
                    </a>
                </div>
                <form id="admin-logout-form-top" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li><!--end topbar-profile-->
        </ul><!--end topbar-nav-->

        <ul class="list-unstyled topbar-nav mb-0">                        
            <li>
                <button class="nav-link button-menu-mobile nav-icon" id="togglemenu">
                    <i class="ti ti-menu-2"></i>
                </button>
            </li> 
            <li class="hide-phone app-search">
                <form role="search" action="#" method="get">
                    <input type="search" name="search" class="form-control top-search mb-0" placeholder="Type text...">
                    <button type="submit"><i class="ti ti-search"></i></button>
                </form>
            </li>                       
        </ul>
    </nav>
    <!-- end navbar-->
</div>
<!-- Top Bar End -->