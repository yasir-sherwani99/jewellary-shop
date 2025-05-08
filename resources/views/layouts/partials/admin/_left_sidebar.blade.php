<div class="left-sidebar show" style="background-color: #f8f9fb;">
    <!-- LOGO -->
    <div class="brand">
        <a href="{{ route('admin.dashboard') }}" class="logo">
            <span>
                <img 
                    src="{{ asset('admin-assets/images/logos/logo-black.svg') }}" 
                    alt="J1 Door" 
                    class="logo-sm"
                />
            </span>
        </a>
    </div>
    <!--end logo-->
    <div class="menu-content h-100" data-simplebar>
        <div class="menu-body navbar-vertical tab-content">
            <div class="collapse navbar-collapse" id="sidebarCollapse">
                <!-- Navigation -->
                <ul class="navbar-nav">
                    <li class="menu-label mt-0">D<span>ashboard</span></li>
                    <li class="nav-item">
                        <a class="nav-link active"  href="{{ route('admin.dashboard') }}">
                            <i class="ti ti-home menu-icon"></i><span>Dashboard</span>
                        </a>
                    </li>
                    <?php
                        $pendingOrders = \App\Models\Order::pending()->count();
                    ?>
                    <li class="menu-label mt-0">Order <span>Section</span></li>
                    <li class="nav-item">
                        <a class="nav-link" href="#sidebarOrders" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarOrders">
                            <i class="ti ti-shopping-cart menu-icon"></i>
                            <span>Orders</span>
                            <span class="badge bg-dark text-light ms-2">{{ $pendingOrders }}</span>
                        </a>
                        <div class="collapse {{ request()->routeIs('admin.orders.new') || request()->routeIs('admin.orders.cancel') || request()->routeIs('admin.orders.log') ? 'navbar-collapse show' : '' }}" id="sidebarOrders">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a href="{{ route('admin.orders.new') }}" class="nav-link {{ request()->routeIs('admin.orders.new') ? 'active' : '' }}">
                                        New Orders
                                        <span class="badge bg-dark text-light ms-2">{{ $pendingOrders }}</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.orders.cancel') }}" class="nav-link {{ request()->routeIs('admin.orders.cancel') ? 'active' : '' }}">
                                        Cancel / Return Orders
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.orders.log') }}" class="nav-link {{ request()->routeIs('admin.orders.log') ? 'active' : '' }}">
                                        Orders Log
                                    </a>
                                </li> 
                            </ul>
                        </div>
                    </li>

                    <!-- <li class="menu-label mt-0">Product <span>Section</span></li>
                    <li class="nav-item">
                        <a class="nav-link" href="#sidebarProduct" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarProduct">
                            <i class="ti ti-briefcase menu-icon"></i>
                            <span>Products</span>
                        </a>
                        <div class="collapse {{-- request()->routeIs('products.index') || request()->routeIs('products.create') || request()->routeIs('products.edit') || request()->routeIs('products.show') || request()->routeIs('products.images.index') || request()->routeIs('products.images.create') ? 'navbar-collapse show' : '' --}}" id="sidebarProduct">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a href="{{-- route('products.index') --}}" class="nav-link {{-- request()->routeIs('products.index') || request()->routeIs('products.edit') || request()->routeIs('products.show') || request()->routeIs('products.images.index') || request()->routeIs('products.images.create') ? 'active' : '' --}}">
                                        Products List
                                    </a>
                                </li>                               
                                <li class="nav-item">
                                    <a href="{{-- route('products.create') --}}" class="nav-link {{-- request()->routeIs('products.create') ? 'active' : '' --}}">
                                        New Product
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="menu-label mt-0">User <span>Section</span></li>
                    <li class="nav-item">
                        <a class="nav-link" href="#sidebarUser" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarUser">
                            <i class="ti ti-user menu-icon"></i>
                            <span>Users/Clients</span>
                        </a>
                        <div class="collapse {{-- request()->routeIs('users.index') || request()->routeIs('users.profile') || request()->routeIs('guests.index') ? 'navbar-collapse show' : '' --}}" id="sidebarUser">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a href="{{-- route('users.index') --}}" class="nav-link {{-- request()->routeIs('users.index') || request()->routeIs('users.profile') ? 'active' : '' --}}">
                                        Users List
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    
                    <li class="menu-label mt-0">Customer Support <span>Section</span></li>
                    <li class="nav-item">
                        <a class="nav-link" href="#sidebarSupport" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarSupport">
                            <i class="ti ti-help menu-icon"></i>
                            <span>Support</span>
                            <span class="badge bg-dark text-light ms-2">3</span>
                        </a>
                        <div class="collapse {{-- request()->routeIs('support.open') || request()->routeIs('support.user-feedback') || request()->routeIs('support.admin-feedback') || request()->routeIs('support.close') || request()->routeIs('support.log') || request()->routeIs('ticket.details') || request()->routeIs('messages.index') || request()->routeIs('message.details') ? 'navbar-collapse show' : '' --}}" id="sidebarSupport">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a href="{{-- route('support.open') --}}" class="nav-link {{-- request()->routeIs('support.open') || request()->routeIs('ticket.details') ? 'active' : '' --}}">
                                        Open Tickets
                                        <span class="badge bg-dark text-light ms-2">3</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>                   
                    
                    <li class="menu-label mt-0">Settings <span>Section</span></li>
                    <li class="nav-item">
                        <a class="nav-link" href="#sidebarSettings" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarSettings">
                            <i class="ti ti-settings menu-icon"></i>
                            <span>Settings</span>
                        </a>
                        <div class="collapse {{-- request()->routeIs('settings.index') || request()->routeIs('settings.edit') || request()->routeIs('settings.pages.edit') || request()->is('setting/page/privacy-policy') || request()->is('setting/page/terms-and-conditions') ? 'navbar-collapse show' : '' --}}" id="sidebarSettings">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a href="{{-- route('settings.index') --}}" class="nav-link {{-- request()->routeIs('settings.index') || request()->routeIs('settings.edit') ? 'active' : '' --}}">
                                        General Settings
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{-- route('settings.pages.edit', 'privacy-policy') --}}" class="nav-link {{-- request()->is('setting/page/privacy-policy') ? 'active' : '' --}}">
                                        Privacy Policy
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{-- route('settings.pages.edit', 'terms-and-conditions') --}}" class="nav-link {{-- request()->is('setting/page/terms-and-conditions') ? 'active' : '' --}}">
                                        Terms of Use
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="#sidebarAdmin" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAdmin">
                            <i class="ti ti-user-check menu-icon"></i>
                            <span>Admins</span>
                        </a>
                        <div class="collapse {{-- request()->routeIs('admins.index') || request()->routeIs('admins.create') || request()->routeIs('admins.edit') || request()->routeIs('admins.show') ? 'navbar-collapse show' : '' --}}" id="sidebarAdmin">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a href="{{-- route('admins.index') --}}" class="nav-link {{-- request()->routeIs('admins.index') || request()->routeIs('admins.edit') || request()->routeIs('admins.show') ? 'active' : '' --}}">
                                        Admins List
                                    </a>
                                </li>                                
                                <li class="nav-item">
                                    <a href="{{-- route('admins.create') --}}" class="nav-link {{-- request()->routeIs('admins.create') ? 'active' : '' --}}">
                                        New Admin
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li> -->
                    <li class="menu-label mt-0">L<span>ogout</span></li>
                    <li class="nav-item">
                        <form id="logout-form-admin-sidebar" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                        <a 
                            class="nav-link" 
                            href="javascript:;"
                            onClick="event.preventDefault(); document.getElementById('logout-form-admin-sidebar').submit();"
                        >
                            <i class="ti ti-logout menu-icon"></i><span>Logout</span>
                        </a>
                    </li>
                </ul><!--end navbar-nav--->
            </div><!--end sidebarCollapse-->
        </div>
    </div>    
</div>
<!-- end left-sidenav-->